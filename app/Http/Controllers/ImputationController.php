<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Task;
use App\Models\User;
use App\Enum\RoleEnum;
use App\Enum\TaskEnum;
use App\Models\Courrier;
use App\Enum\CourrierEnum;
use App\Models\Annotation;
use App\Models\Imputation;
use App\Models\Departement;
use App\Helper\DeleteAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\StoreImputationRequest;
use App\Notifications\ImputationNotification;
use App\Http\Requests\UpdateImputationRequest;

class ImputationController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImputationRequest $request): RedirectResponse
    {

        $item = Imputation::create($request->safe()->except(['annotation_id', 'departement_id', 'notif']));
        $item->generateId('IMP');
        // Save departements pivot value
        $item->departements()->attach($request->departement_id);
        // Save annotations pivot value
        $item->annotations()->attach($request->annotation_id);
        // Update courrier status
        if ($item->courrier->Register()) {
            $item->courrier->update(['etat' => CourrierEnum::IMPUTE]);
        }
        // Create tasks for imputation
        if (! empty($request->annotation_id)) {
            $tache = Annotation::whereIn('id', $request->annotation_id)->get();
            $tache->map(function ($row) use ($item, $request) {
                $task = Task::create([
                    'courrier_id' => $item->courrier->id,
                    'createur_id' => Auth::user()->id,
                    'imputation_id' => $item->id,
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
        $users = User::whereIn('userable_id', $request->departement_id)->whereRole(RoleEnum::SUPERUSER)->get(['email', 'id']);
        $emails = $users->pluck('email')->toArray();

        // Send notification
        $notification = new ImputationNotification($item, "Vous avez été imputé d'un nouveau courrier");
        if ($request->notif == 1) {
            Notification::route('mail', $emails)->notify($notification);
        } else {
            Notification::send($users, $notification);
        }
        $ref = $item->courrier->numero;
        $this->history($item->courrier->id, 'Impuatation', "Imputé le courrier arrivé le N° $ref");
        toastr()->success('Imputation ajoutée avec succès!');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Imputation $imputation): View
    {
        $this->authorize('view', $imputation);

        return view('imputation.show', compact('imputation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imputation $imputation): View
    {
        $this->authorize('update', $imputation);
        $user = Auth::user();
        $courrier = Courrier::with('nature')->when(! $user->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest('id')->get(['id', 'numero', 'reference', 'date']);
        $departement = Departement::with('subdepartements')->when(! $user->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest('id')->get();

        return view('imputation.update', compact('imputation', 'courrier', 'departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImputationRequest $request, Imputation $imputation): RedirectResponse
    {
        $imputation->update($request->safe()->except(['annotation_id', 'departement_id']));
        $imputation->annotations()->sync($request->annotation_id);
        $imputation->departements()->sync($request->departement_id);
        toastr()->success('Imputation mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $imputation): JsonResponse
    {
        $delete = Imputation::findOrFail($imputation);
        $this->journal("Suppression du l'imputation N°$delete->id");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Imputation::with('user')->onlyTrashed()->latest('id')->paginate(15);

        return view('imputation.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Imputation::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré l'imputation N°$row->id");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Imputation::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("Suppression definitive de l'imputation N°$row->id");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré tous les imputations');

        return $this->All_restore(Imputation::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vider la corbeille  des imputations');

        return $this->All_remove(Imputation::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }
}
