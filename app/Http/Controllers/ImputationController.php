<?php

namespace App\Http\Controllers;

use App\Enum\CourrierEnum;
use App\Enum\RoleEnum;
use App\Enum\TaskEnum;
use App\Models\Courrier;
use App\Models\Imputation;
use App\Models\Departement;
use Illuminate\Support\Arr;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImputationRequest;
use App\Http\Requests\UpdateImputationRequest;
use App\Models\Annotation;
use App\Models\Task;
use App\Models\User;
use App\Notifications\ImputationNotification;
use Auth;
use Illuminate\Support\Facades\Notification;

class ImputationController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImputationRequest $request)
    {
        $courrier = Courrier::findOrFail($request->courrier_id);

        // Save imputation pivot value
        $pivot_value = Arr::except($request->validated(), ['departement_id', 'annotation_id', 'notif']);
        $courrier->imputations()->attach($request->departement_id, $pivot_value);

        // Update courrier status
        if($courrier->Register()) {
            $courrier->update(['etat' => CourrierEnum::IMPUTE]);
        }

        // Get imputation
        $imp_id = Imputation::whereReference($request->reference)->firstOrFail(['id', 'reference']);

        // Save annotations pivot value
        $imp_id->annotations()->attach($request->annotation_id);

        // Create tasks for imputation
        if (!empty($request->annotation_id)) {
            $tache = Annotation::whereIn('id', $request->annotation_id)->get();

            $tache->map(function ($row) use ($courrier, $imp_id, $request) {
              $task = Task::create([
                        'courrier_id' => $courrier->id,
                        'createur_id' => Auth::user()->id,
                        'imputation_id' => $imp_id->id,
                        'nom' => $row->nom,
                        'type' => 'imputation',
                        'description' => $row->nom,
                        'debut' => now()->today(),
                        'fin' => $request->delai,
                        'etat' => TaskEnum::EN_COURS,
                    ]);
                    $task->generateId('TA');
                    return $task;
            });
        }

        // Get notifiable users' emails
        $users = User::whereIn('departement_id', $request->departement_id)
            ->whereRole(RoleEnum::SUPERUSER)
            ->get(['email','id']);
        $emails = $users->pluck('email')->toArray();

        // Send notification
        $notification = new ImputationNotification($imp_id, "Vous avez été imputé d'un nouveau courrier");
        if ($request->notif == 1) {
            Notification::route('mail', $emails)->notify($notification);
        } else {

            Notification::send($users, $notification);
        }

        $this->history($courrier->id, "Impuatation", "Imputé le courrier arrivé le N° $courrier->numero");
        toastr()->success('Imputation ajoutée avec succès!');
        return back();
    }




    /**
     * Display the specified resource.
     */
    public function show(Imputation $imputation)
    {
        return view('imputation.show', compact('imputation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imputation $imputation)
    {
        $courrier = Courrier::with('nature')->latest()->get(['id','numero','reference','date']);
        $departement = Departement::all();
        return view('imputation.update', compact('imputation','courrier','departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImputationRequest $request, Imputation $imputation)
    {
        $imputation->update($request->validated());
        $imputation->annotations()->sync($request->annotation_id);
        toastr()->success('Imputation mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $imputation)
    {
        $delete = Imputation::findOrFail($imputation);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Imputation::with('user')->onlyTrashed()->latest()->paginate(15);
        return view('imputation.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Imputation::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Imputation::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Imputation::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Imputation::onlyTrashed());
    }
}
