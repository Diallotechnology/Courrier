<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use App\Helper\DeleteAction;
use App\Models\Correspondant;
use App\Http\Requests\FormeCorrespondantRequest;

class CorrespondantController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormeCorrespondantRequest $request)
    {
        Correspondant::create($request->validated());
        toastr()->success('Correspondant ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Correspondant $correspondant)
    {
        return view('correspondant.show', compact('correspondant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Correspondant $correspondant)
    {
        $structure = Structure::all(['id','nom']);
        return view('correspondant.update', compact('correspondant','structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormeCorrespondantRequest $request, Correspondant $correspondant)
    {
        $correspondant->update($request->validated());
        toastr()->success('Correspondant mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $correspondant)
    {
        $delete = Correspondant::findOrFail($correspondant);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Correspondant::with('structure')->onlyTrashed()->latest()->paginate(15);
        return view('correspondant.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Correspondant::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Correspondant::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Correspondant::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Correspondant::onlyTrashed());
    }
}
