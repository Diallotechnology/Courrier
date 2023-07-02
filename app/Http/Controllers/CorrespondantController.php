<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Structure;
use App\Helper\DeleteAction;
use App\Models\Correspondant;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\FormeCorrespondantRequest;

class CorrespondantController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormeCorrespondantRequest $request): RedirectResponse
    {
        $item = Correspondant::create($request->validated());
        $this->journal("Ajout du correspondant N°$item->id");
        toastr()->success('Correspondant ajouter avec success!');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Correspondant $correspondant): View
    {
        return view('correspondant.show', compact('correspondant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Correspondant $correspondant): View
    {
        $structure = Auth::user()->isSuperadmin() ? Structure::all(['id', 'nom']) : new Collection();

        return view('correspondant.update', compact('correspondant', 'structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormeCorrespondantRequest $request, Correspondant $correspondant): RedirectResponse
    {
        $correspondant->update($request->validated());
        toastr()->success('Correspondant mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $correspondant): JsonResponse
    {
        $delete = Correspondant::findOrFail($correspondant);
        $this->journal("Suppression du correspondant N°$delete->id");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Correspondant::with('structure')->onlyTrashed()->latest()->paginate(15);

        return view('correspondant.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Correspondant::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré le correspondant N°$row->id");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Correspondant::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("Suppression definitive du correspondant N°$row->id");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré tous les correspondant');

        return $this->All_restore(Correspondant::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vider la corbeille  des correspondants');

        return $this->All_remove(Correspondant::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }
}
