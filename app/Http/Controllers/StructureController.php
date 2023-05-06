<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Structure;
use App\Http\Requests\StoreStructureRequest;
use App\Http\Requests\UpdateStructureRequest;
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
    public function update(UpdateStructureRequest $request, Structure $structure)
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
}
