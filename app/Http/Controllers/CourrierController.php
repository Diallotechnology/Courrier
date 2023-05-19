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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourrierRequest $request)
    {
        $item = Courrier::create($request->validated());
        $this->history($item->id, "Enregistrement","Enregistré le courrier arrivé le N° $item->numero");
        if ($request->hasFile('files')):
            foreach ($request->file('files') as $key => $row):
                // renome le document
                $filename =  $row->hashName();
                $chemin = $row->storeAs('courrier/arriver', $filename, 'public');
                $data = new Document([
                    'libelle' => $row->getClientOriginalName(),
                    'user_id' => Auth::user()->id,
                    'type' => 'Arrivé',
                    'chemin' => $chemin,
                ]);
                $item->documents()->save($data);
            endforeach;
        endif;
        toastr()->success('Courrier ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Courrier $arriver)
    {
        // \dd($arriver->load('tasks'));
        $imp = Imputation::with('departement')->whereCourrierId($arriver->id)->get()->groupBy('reference');
        // \dd($imp);
        return view('arriver.show', compact('arriver','imp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courrier $arriver)
    {
        $correspondant = Correspondant::orderBy('nom')->get();
        $type = Nature::orderBy('nom')->get();
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
                    'libelle' => $row->getClientOriginalName(),
                    'user_id' => Auth::user()->id,
                    'type' => 'Arrivé',
                    'chemin' => $chemin,
                ]);
                $arriver->documents()->save($data);
            endforeach;
            $this->history($arriver->id, "Mise à jour de document","Ajoute de nouveau document au courrier arrivé le N° $arriver->numero");
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
        return  $this->supp($delete);
    }


    public function trash()
    {
        $rows = Courrier::with('nature','correspondant')->onlyTrashed()->latest()->paginate(15);
        return view('arriver.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Courrier::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Courrier::onlyTrashed()->whereId($id)->firstOrFail();
        if($row->documents) {
            foreach($row->documents as $item) {
                $this->file_delete($item);
            }
        }
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Courrier::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Courrier::onlyTrashed());
    }
}
