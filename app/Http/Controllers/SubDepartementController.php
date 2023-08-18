<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Http\Requests\StoreSubDepartementRequest;
use App\Models\Departement;
use App\Models\SubDepartement;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class SubDepartementController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubDepartementRequest $request): RedirectResponse
    {
        $item = SubDepartement::create($request->validated());
        $this->journal("Ajout du sous departement N°$item->id");
        toastr()->success('Departement ajouter avec success!');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SubDepartement $subdepartement): View
    {
        $this->authorize('view', $subdepartement);

        return view('subdepartement.show', compact('subdepartement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubDepartement $subdepartement): View
    {
        $this->authorize('update', $subdepartement);
        $departement = Auth::user()->isSuperadmin() ?
         Departement::all() : Departement::ByStructure()->get();

        return view('subdepartement.update', compact('departement', 'subdepartement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSubDepartementRequest $request, SubDepartement $subdepartement): RedirectResponse
    {
        $subdepartement->update($request->validated());
        toastr()->success('Departement mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $departement): JsonResponse
    {
        $delete = SubDepartement::findOrFail($departement);
        $this->journal("Suppression du sous departement N°$delete->id");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = SubDepartement::with('departement')->onlyTrashed()
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest()->paginate(15);

        return view('subdepartement.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = SubDepartement::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré le sous departement N°$row->id");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = SubDepartement::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("Suppression definitive du sous departement N°$row->id");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré tous les sous departement');

        return $this->All_restore(SubDepartement::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vider la corbeille des sous departements');

        return $this->All_remove(SubDepartement::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }
}
