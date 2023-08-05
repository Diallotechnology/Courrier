<?php

namespace App\Http\Controllers;

use App\Exports\CourrierExport;
use App\Models\Task;
use App\Models\Nature;
use App\Jobs\UplodeJob;
use App\Models\Courrier;
use App\Helper\DeleteAction;
use App\Models\Correspondant;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCourrierRequest;
use App\Http\Requests\UpdateCourrierRequest;

class CourrierController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourrierRequest $request): RedirectResponse
    {
        $item = Courrier::create($request->validated());
        $item->generateId('CA');
        $ref = $item->numero;
        $this->history($item->id, 'Enregistrement', "Enregistré le courrier arrivé REF N° $ref");
        $this->file_uplode($request, $item);
        $this->journal("Ajout du courrier REF N°.$ref");
        toastr()->success('Courrier ajouter avec success!');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Courrier $arriver): View
    {
        $this->authorize('view', $arriver);
        $task = Task::with('users')->whereIn('imputation_id', $arriver->imputations()->pluck('id'))->get();
        return view('arriver.show', compact('arriver', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courrier $arriver): View
    {
        $this->authorize('update', $arriver);
        $user = Auth::user();
        $correspondantQuery = Correspondant::with('structure')->orderBy('nom')
            ->when(! $user->isSuperadmin(), fn ($query) => $query->ByStructure());
        $correspondant = $correspondantQuery->get();

        $typeQuery = Nature::orderBy('nom')->when(! $user->isSuperadmin(), fn ($query) => $query->ByStructure());
        $type = $typeQuery->latest()->get();

        return view('arriver.update', compact('arriver', 'correspondant', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourrierRequest $request, Courrier $arriver): RedirectResponse
    {
        $arriver->update($request->validated());
        $this->file_uplode($request, $arriver);
        if ($request->hasFile('files')) {
            $this->history($arriver->id, 'Mise à jour de document', "Ajoute de nouveau document au courrier arrivé N° $arriver->numero");
        }
        toastr()->success('Courrier mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $arriver): JsonResponse
    {
        $delete = Courrier::findOrFail($arriver);
        $this->journal("Suppression du courrier REF N°$delete->numero");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Courrier::with('nature', 'correspondant')->onlyTrashed()
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest()->paginate(15);

        return view('arriver.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Courrier::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré le courrier REF N°$row->numero");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Courrier::onlyTrashed()->whereId($id)->firstOrFail();
        if ($row->documents) {
            foreach ($row->documents as $item) {
                $this->file_delete($item);
            }
        }
        $this->journal("Suppression definitive du courrier REF N°$row->numero");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré de tous les courriers');

        return $this->All_restore(Courrier::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vidé la corbeille du courrier');

        return $this->All_remove(Courrier::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }
}
