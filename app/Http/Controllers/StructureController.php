<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Structure;
use App\Http\Requests\StoreStructureRequest;
use Str;

class StructureController extends Controller
{

    use DeleteAction;
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStructureRequest $request)
    {
        $filename = Str::random(20).$request->logo->extension();
        $chemin = $request->file('logo')->storeAs('structure/logo', $filename, 'public');

        Structure::create([
            'nom' => $request->nom,
        ]);
        toastr()->success('Structure ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Structure $structure)
    {
        return view('structure.show', compact('structure'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Structure $structure)
    {
        return view('structure.update', compact('structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStructureRequest $request, Structure $structure)
    {
        $structure->update($request->validated());
        toastr()->success('Structure mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(int $structure)
    {
        $delete = Structure::findOrFail($structure);
        $this->file_delete($delete);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Structure::withCount('departements')->onlyTrashed()->latest()->paginate(15);
        return view('structure.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Structure::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {
        $row = Structure::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Structure::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Structure::onlyTrashed());
    }
}
