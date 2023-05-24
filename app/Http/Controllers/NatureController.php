<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;


/**
 *
 */
class NatureController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate(['nom'=>'required|string|max:50']);
        $item = Nature::create($data);
        $this->journal("Ajout de la nature de courrier N°$item->id");
        toastr()->success('Nature ajouter avec success!');
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nature $nature)
    {
        return view('nature.update', compact('nature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nature $nature)
    {

        $data = $request->validate(['nom'=>'required|string|max:100']);
        $nature->update($data);
        toastr()->success('Nature mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $nature)
    {
        $delete = Nature::findOrFail($nature);
        $this->journal("Suppression de la nature de courrier N°$delete->id");
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Nature::onlyTrashed()->latest()->paginate(15);
        return view('nature.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Nature::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré de la nature de courrier N°$row->id");
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Nature::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("Suppression definitive de la nature de courrier N°$row->id");
        return $this->Remove($row);
    }


    public function all_recover() {
        $this->journal("Restauré tous les natures de courrier");
        return $this->All_restore(Nature::onlyTrashed());
    }

    public function all_delete() {
        $this->journal("Vider la corbeille  des natures de courrier");
        return $this->All_remove(Nature::onlyTrashed());
    }
}
