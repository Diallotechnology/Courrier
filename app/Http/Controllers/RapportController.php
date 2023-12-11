<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Http\Requests\StoreRapportRequest;
use App\Http\Requests\UpdateRapportRequest;
use App\Models\Courrier;
use App\Models\Rapport;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RapportController extends Controller
{
    use DeleteAction;

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        Auth::user()->can('create', Rapport::class);
        $auth = Auth::user();
        $courrierQuery = Courrier::with('nature')->when(! $auth->isSuperadmin(), fn ($query) => $query->ByStructure());
        $courrier = $courrierQuery->latest()->get();
        $type = Rapport::TYPE;
        $user = User::with('userable')->when(! $auth->isSuperadmin(), fn ($query) => $query->StructureUser())
            ->whereNot('id', $auth->id)->get()->groupBy('userable.nom');

        return view('rapport.create', \compact('courrier', 'type', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRapportRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $data = Arr::except($request->validated(), ['files', 'personne_id']);
            $rapport = Rapport::create($data);
            if (! empty($request->input('personne_id'))) {
                $rapport->utilisateurs()->attach($request->input('personne_id'));
            }
            $rapport->generateId('RA');
            $ref = $rapport->numero;
            $this->file_uplode($request, $rapport);
            $this->journal("Ajout du rapport REF N°$ref");
            toastr()->success('Rapport ajouter avec success!');
        });

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Rapport $rapport): View
    {
        $this->authorize('view', $rapport);

        return view('rapport.show', compact('rapport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rapport $rapport): View
    {
        $this->authorize('update', $rapport);
        $auth = Auth::user();
        $courrier = Courrier::all();
        $type = Rapport::TYPE;
        $user = User::with('userable')->when(! $auth->isSuperadmin(), fn ($query) => $query->StructureUser())
            ->whereNot('id', $auth->id)->get()->groupBy('userable.nom');

        return view('rapport.update', compact('rapport', 'courrier', 'type', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRapportRequest $request, Rapport $rapport): RedirectResponse
    {
        DB::transaction(function () use ($request, $rapport) {
            $data = Arr::except($request->validated(), ['files', 'personne_id']);
            $rapport->update($data);
            if (! empty($request->input('personne_id'))) {
                $rapport->utilisateurs()->sync($request->input('personne_id'));
            }
            $this->file_uplode($request, $rapport);
            toastr()->success('Rapport mise à jour avec success!');
        });

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $rapport): JsonResponse
    {
        $delete = Rapport::findOrFail($rapport);

        $this->journal("Suppression du rapport REF N°$delete->reference");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Rapport::onlyTrashed()->latest()
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->paginate(15);

        return view('rapport.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Rapport::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré le rapport REF N°$row->reference");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Rapport::onlyTrashed()->whereId($id)->firstOrFail();
        if ($row->documents) {
            foreach ($row->documents as $item) {
                $this->file_delete($item);
            }
        }
        $this->journal("Suppression definitive du rapport REF N°$row->reference");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré tous les rapport');

        return $this->All_restore(Rapport::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vider la corbeille  des rapport');

        return $this->All_remove(Rapport::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }
}
