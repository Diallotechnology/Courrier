<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Http\Requests\StoreDepartementRequest;
use App\Jobs\DepartMailJob;
use App\Models\Departement;
use App\Models\Structure;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class DepartementController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartementRequest $request): RedirectResponse
    {
        $item = Departement::create($request->validated());
        $this->journal("Ajout du departement N°$item->id");
        toastr()->success('Departement ajouter avec success!');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement): View
    {
        $this->authorize('view', $departement);

        return view('departement.show', compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement): View
    {
        $this->authorize('update', $departement);
        $structure = Auth::user()->isSuperadmin() ? Structure::all(['id', 'nom']) : new Collection();

        return view('departement.update', compact('departement', 'structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartementRequest $request, Departement $departement): RedirectResponse
    {
        $departement->update($request->validated());
        toastr()->success('Departement mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $departement): JsonResponse
    {
        $delete = Departement::findOrFail($departement);
        $this->journal("Suppression du departement N°$delete->id");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Departement::with('structure')->onlyTrashed()
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest()->paginate(15);

        return view('departement.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Departement::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré le departement N°$row->id");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Departement::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("Suppression definitive du departement N°$row->id");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré tous les departement');

        return $this->All_restore(Departement::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vider la corbeille  des departements');

        return $this->All_remove(Departement::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }
}
