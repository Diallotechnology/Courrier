<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Models\Courrier;
use App\Models\Document;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;
use App\Models\Correspondant;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCourrierRequest;
use App\Http\Requests\UpdateCourrierRequest;
use App\Models\Imputation;

class CourrierController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourrierRequest $request)
    {
        // foreach (range(1,15) as $value) {
            $item = Courrier::create($request->validated());
            $ref = $item->generateId('CA');
        // }
        // \dd('ok');
        $this->history($item->id, "Enregistrement","Enregistré le courrier arrivé REF N° $item->numero");
        if ($request->hasFile('files')):
            foreach ($request->file('files') as $key => $row):
                // renome le document
                $filename =  $row->hashName();
                $chemin = $row->storeAs('courrier/arriver', $filename, 'public');
                $data = new Document([
                    'libelle' => $ref->numero,
                    'user_id' => Auth::user()->id,
                    'structure_id' => Auth::user()->structure(),
                    'type' => 'Arrivé',
                    'chemin' => $chemin,
                ]);
                $item->documents()->save($data);
            endforeach;
        endif;
        $this->journal("Ajout du courrier REF N°$ref->numero");
        toastr()->success('Courrier ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Courrier $arriver)
    {
        $this->authorize('view', $arriver);
        $imp = Imputation::with('departements')->whereCourrierId($arriver->id)->get();
        return view('arriver.show', compact('arriver','imp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courrier $arriver)
    {
        $this->authorize('update', $arriver);
        $user = Auth::user();
        $correspondantQuery = Correspondant::with('structure')->orderBy('nom')
        ->when(!$user->isSuperadmin(), fn($query) => $query->ByStructure());
        $correspondant = $correspondantQuery->get();

        $typeQuery = Nature::orderBy('nom')->when(!$user->isSuperadmin(), fn($query) => $query->ByStructure());
        $type = $typeQuery->latest()->get();

        return view('arriver.update', compact('arriver','correspondant','type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourrierRequest $request, Courrier $arriver)
    {
        $arriver->update($request->validated());
        if ($request->hasFile('files')):
            foreach ($request->file('files') as $key => $row):
                // renome le document
                $filename =  $row->hashName();
                $chemin = $row->storeAs('courrier/arriver', $filename, 'public');
                $data = new Document([
                    'libelle' => $arriver->numero,
                    'user_id' => Auth::user()->id,
                    'structure_id' => Auth::user()->structure(),
                    'type' => 'Arrivé',
                    'chemin' => $chemin,
                ]);
                $arriver->documents()->save($data);
            endforeach;
            $this->history($arriver->id, "Mise à jour de document","Ajoute de nouveau document au courrier arrivé N° $arriver->numero");
        endif;
        toastr()->success('Courrier mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $arriver)
    {
        $delete = Courrier::findOrFail($arriver);
        $this->journal("Suppression du courrier REF N°$delete->numero");
        return  $this->supp($delete);
    }


    public function trash()
    {
        $rows = Courrier::with('nature','correspondant')->onlyTrashed()
        ->when(!Auth::user()->isSuperadmin(), fn($query) => $query->ByStructure())
        ->latest()->paginate(15);
        return view('arriver.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Courrier::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré le courrier REF N°$row->numero");
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Courrier::onlyTrashed()->whereId($id)->firstOrFail();
        if($row->documents) {
            foreach($row->documents as $item) {
                $this->file_delete($item);
            }
        }
        $this->journal("Suppression definitive du courrier REF N°$row->numero");
        return $this->Remove($row);
    }


    public function all_recover() {
        $this->journal("Restauré de tous les courriers");
        return $this->All_restore(Courrier::onlyTrashed()->when(!Auth::user()->isSuperadmin(), fn($query) => $query->ByStructure()));
    }

    public function all_delete() {
        $this->journal("Vidé la corbeille du courrier");
        return $this->All_remove(Courrier::onlyTrashed()->when(!Auth::user()->isSuperadmin(), fn($query) => $query->ByStructure()));
    }
}
