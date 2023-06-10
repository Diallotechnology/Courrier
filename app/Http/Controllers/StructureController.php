<?php

namespace App\Http\Controllers;

use Str;
use App\Models\Licence;
use App\Models\Structure;
use App\Helper\DeleteAction;
use App\Http\Requests\StoreStructureRequest;

class StructureController extends Controller
{

    use DeleteAction;
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStructureRequest $request)
    {
        if(!empty($request->logo)) {
            $filename = Str::random(20).$request->logo->extension();
            $chemin = $request->file('logo')->storeAs('structure/logo', $filename, 'public');
            $data = [
                'nom' => $request->nom,
                'logo' => $chemin,
                'email' => $request->email,
                'contact' => $request->contact,
                'adresse' => $request->adresse,
                'description' => $request->description,
            ];
        } else {
            $data = [
                'nom' => $request->nom,
                'email' => $request->email,
                'contact' => $request->contact,
                'adresse' => $request->adresse,
                'description' => $request->description,
            ];
        }
        $structure = Structure::create($data);
        // Génération d'un code de licence unique
        $licenseCode = Str::random(64);

        // Création de la licence associée à la structure
        Licence::create([
            'structure_id' => $structure->id,
            'code' => $licenseCode,
            'date_expiration' => now()->addDays(15), // Exemple : licence valide pendant 30 jours
            'version' => '1.0', // Version de la licence
            'active' => true, // Activation de la licence
        ]);
        toastr()->success('Structure ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Structure $structure)
    {
        $this->authorize('view', $structure);
        return view('structure.show', compact('structure'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Structure $structure)
    {
        $this->authorize('update', $structure);
        return view('structure.update', compact('structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStructureRequest $request, Structure $structure)
    {
        if(!empty($request->logo)) {
            $this->file_delete($structure);
            $filename = Str::random(20).$request->logo->extension();
            $chemin = $request->file('logo')->storeAs('structure/logo', $filename, 'public');
            $data = [
                'nom' => $request->nom,
                'logo' => $chemin,
                'email' => $request->email,
                'contact' => $request->contact,
                'adresse' => $request->adresse,
                'description' => $request->description,
            ];
            $structure->update($data);
        } else {
            $structure->update($request->validated());
        }

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
