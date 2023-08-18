<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Http\Requests\StoreDepartRequest;
use App\Http\Requests\UpdateDepartRequest;
use App\Models\Correspondant;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Nature;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DepartController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartRequest $request): RedirectResponse
    {

        $item = Depart::create($request->safe()->except(['correspondant_id']));
        $item->generateId('CD');
        $ref = $item->numero;
        if (! empty($request->correspondant_id)) {
            $item->correspondants()->attach($request->correspondant_id);
        }
        $this->file_uplode($request, $item);
        $this->journal("Ajout du courrier depart REF N°$ref");
        toastr()->success('Courrier ajouter avec success!');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Depart $depart): View
    {
        return view('depart.show', compact('depart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depart $depart): View
    {
        $this->authorize('update', $depart);
        $auth = Auth::user();
        $correspondant = Correspondant::with('structure')->orderBy('nom')
            ->when(! $auth->isSuperadmin(), fn ($query) => $query->ByStructure())->get();

        $type = Nature::orderBy('nom')->when(! $auth->isSuperadmin(), fn ($query) => $query->ByStructure())->latest()->get();

        $courrier = Courrier::with('nature', 'correspondant')->when(! $auth->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest()->get(['id', 'numero', 'reference', 'date']);

        $user = User::with('userable')->when(! $auth->isSuperadmin(), fn ($query) => $query->StructureUser())->get()->groupBy('userable.nom');

        return view('depart.update', compact('depart', 'correspondant', 'type', 'courrier', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartRequest $request, Depart $depart): RedirectResponse
    {
        $depart->update($request->safe()->except(['correspondant_id']));
        if (! empty($request->correspondant_id)) {
            $depart->correspondants()->sync($request->correspondant_id);
        }
        $this->file_uplode($request, $depart);
        toastr()->success('Courrier mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $depart): JsonResponse
    {
        $delete = Depart::findOrFail($depart);
        $this->journal("Suppression du courrier depart REF N°$delete->numero");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Depart::with('user', 'courrier')->onlyTrashed()
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest('id')->paginate(15);

        return view('depart.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Depart::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré le courrier depart REF N°$row->numero");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Depart::onlyTrashed()->whereId($id)->firstOrFail();
        if ($row->documents) {
            foreach ($row->documents as $item) {
                $this->file_delete($item);
            }
        }
        $this->journal("Suppression definitive du courrier depart REF N°$row->numero");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {

        $this->journal('Restauré de tous les courriers depart');

        return $this->All_restore(Depart::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vidé la corbeille du courrier depart');

        return $this->All_remove(Depart::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }
}
