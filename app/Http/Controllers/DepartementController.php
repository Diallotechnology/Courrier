<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use App\Models\Departement;
use App\Helper\DeleteAction;
use App\Http\Requests\StoreDepartementRequest;

class DepartementController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartementRequest $request)
    {
        Departement::create($request->validated());
        toastr()->success('Departement ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        return view('departement.show', compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        $structure = Structure::all(['id','nom']);

        return view('departement.update', compact('departement','structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartementRequest $request, Departement $departement)
    {
        $departement->update($request->validated());
        toastr()->success('Departement mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $departement)
    {
        $delete = Departement::findOrFail($departement);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Departement::with('structure')->onlyTrashed()->latest()->paginate(15);
        return view('departement.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Departement::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Departement::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Departement::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Departement::onlyTrashed());
    }
}
