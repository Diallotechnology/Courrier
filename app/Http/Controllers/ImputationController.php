<?php

namespace App\Http\Controllers;

use App\Enum\CourrierEnum;
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
use Auth;

class ImputationController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImputationRequest $request)
    {
        $courrier = Courrier::findOrFail($request->courrier_id);
        // remove departement and annotation array
        $pivot_value = Arr::except($request->validated(),['departement_id','annotation_id']);

        // save imputation pivot value
        $courrier->imputations()->attach($request->departement_id,$pivot_value);
        // update courrier statut
        $courrier->update(['etat' => CourrierEnum::IMPUTE]);
         // get imputation
        $imp_id = Imputation::whereReference($request->reference)->firstOrFail(['id']);

        // save annotations pivot value
        $imp_id->annotations()->attach($request->annotation_id);
        // create task to Imputation
        if(!empty($request->annotation_id)) {
            $tache = Annotation::whereIn('id', $request->annotation_id)->get();
            foreach ($tache as $row) {
                Task::create([
                     'courrier_id' => $courrier->id,
                     'createur_id' => Auth::user()->id,
                     'imputation_id' => $imp_id->id,
                     'nom' => $row->nom,
                     'type' => 'imputation',
                     'description' => $row->nom,
                     'debut' => now()->today(),
                     'fin' => $request->delai,
                 ]);
             }
        }
        $this->history($courrier->id, "Impuatation","Imputé le courrier arrivé le N° $courrier->numero");
        toastr()->success('Imputation ajouter avec success!');
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
