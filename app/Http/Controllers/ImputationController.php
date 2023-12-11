<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enum\CourrierEnum;
use App\Enum\RoleEnum;
use App\Enum\TaskEnum;
use App\Helper\DeleteAction;
use App\Http\Requests\StoreImputationRequest;
use App\Http\Requests\UpdateImputationRequest;
use App\Jobs\ImputationMailJob;
use App\Mail\ImputationMail;
use App\Models\Annotation;
use App\Models\Courrier;
use App\Models\Departement;
use App\Models\Imputation;
use App\Models\SubDepartement;
use App\Models\Task;
use App\Models\User;
use App\Notifications\ImputationNotification;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ImputationController extends Controller
{
    use DeleteAction;

    private function createTasksForImputation(Imputation $imputation, $delai, array $AnnotationIds): void
    {
        $annotations = Annotation::whereIn('id', $AnnotationIds)->get();

        $tasks = $annotations->map(function ($row) use ($delai) {
            return Task::create([
                'createur_id' => Auth::user()->id,
                'nom' => $row->nom,
                'type' => 'imputation',
                'description' => $row->nom,
                'debut' => now()->today(),
                'fin' => $delai,
                'etat' => TaskEnum::EN_ATTENTE,
            ])->generateId('TA');
        });

        $imputation->tasks()->saveMany($tasks);
    }

    private function sendImputationNotification(Imputation $imputation, $notif, array $departementIds, array $subDepartementIds): void
    {
        $users = User::where(function ($query) use ($departementIds, $subDepartementIds) {
            $query->whereHasMorph('userable', [Departement::class], function ($subQuery) use ($departementIds) {
                $subQuery->whereIn('userable_id', $departementIds);
            })->orWhereHasMorph('userable', [SubDepartement::class], function ($subQuery) use ($subDepartementIds) {
                $subQuery->whereIn('userable_id', $subDepartementIds);
            });
        })->whereRole(RoleEnum::SUPERUSER)->get(['email', 'id']);

        if ($users->isNotEmpty()) {

            $notification = new ImputationNotification($imputation, "Vous avez été imputé d'un nouveau courrier");
            Notification::send($users, $notification);
            if ($notif == 1) {
                $notification = new ImputationMail($imputation, "Vous avez été imputé d'un nouveau courrier");
                ImputationMailJob::dispatch($notification, $users)->afterCommit();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImputationRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $annotationId = $request->input('annotation_id');
            $departementIds = $request->input('departement_id');
            $subdepartementIds = $request->input('subdepartement_id');
            $notif = $request->input('notif');

            $item = Imputation::create($request->except(['annotation_id', 'departement_id', 'subdepartement_id', 'notif']));
            $item->generateId('IMP');
            $ref = $item->numero;
            if (! empty($annotationId) && ! empty($departementIds) && ! empty($subdepartementIds)) {
                // Save departements pivot value
                $item->departements()->attach($departementIds);
                $item->subdepartements()->attach($subdepartementIds);
                // Save annotations pivot value
                $item->annotations()->attach($annotationId);
                // Update courrier status
                if ($item->courrier->Register()) {
                    $item->courrier->update(['etat' => CourrierEnum::IMPUTE]);
                }
                // Create tasks for imputation
                $this->createTasksForImputation($item, $request->input('delai'), $annotationId);
                // Get notifiable users' emails
                $this->sendImputationNotification($item, $notif, $departementIds, $subdepartementIds);
                $ref = $item->courrier->numero;
                $this->history($item->courrier->id, 'Imputation', "Imputé le courrier arrivé le N°$ref");
                toastr()->success('Imputation ajoutée avec succès!');
            }
        });

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Imputation $imputation)
    {
        $this->authorize('view', $imputation);

        return view('imputation.show', compact('imputation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imputation $imputation): View
    {
        $this->authorize('update', $imputation);

        $user = Auth::user();
        $courrier = Courrier::when(! $user->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest('id')->get(['id', 'numero', 'reference', 'date']);

        $id = $user->departements->where('pivot.type', 'division')->pluck('id')->toArray();
        $subid = $user->departements->where('pivot.type', 'sub_division')->pluck('id')->toArray();
        $divisionQuery = Departement::query();
        $sub_divisionQuery = SubDepartement::query();

        if (! empty($id)) {
            $divisionQuery->whereIn('id', $id);
        } elseif (! $user->isSuperadmin()) {
            $divisionQuery->ByStructure();
        }
        $division = $divisionQuery->get();

        if (! empty($subid)) {
            $sub_divisionQuery->whereIn('id', $id);
        } elseif (! $user->isSuperadmin()) {
            $sub_divisionQuery->whereIn('departement_id', $division->pluck('id'));
        }
        $sub_division = $sub_divisionQuery->get();

        return view('imputation.update', compact('imputation', 'courrier', 'division', 'sub_division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImputationRequest $request, Imputation $imputation): RedirectResponse
    {
        DB::transaction(function () use ($request, $imputation) {
            if (! empty($request->departement_id) && ! empty($request->subdepartement_id) && ! empty($request->annotation_id)) {
                $imputation->update($request->except(['annotation_id', 'departement_id', 'subdepartement_id']));
                $imputation->annotations()->sync($request->input('annotation_id'));
                $imputation->departements()->sync($request->input('departement_id'));
                $imputation->subdepartements()->sync($request->input('subdepartement_id'));

                $missingAnnotationIds = collect($request->input('annotation_id'))->diff($imputation->annotations->pluck('id'))->toArray();
                $missingDepartementIds = collect($request->input('departement_id'))->diff($imputation->departements->pluck('id'))->toArray();
                $missingSubDepartementIds = collect($request->input('subdepartement_id'))->diff($imputation->subdepartements->pluck('id'))->toArray();

                // Create tasks for imputation
                $this->createTasksForImputation($imputation, $request->input('delai'), $missingAnnotationIds);

                // Get notifiable users' emails
                $this->sendImputationNotification($imputation, $request->input('notif'), $missingDepartementIds, $missingSubDepartementIds);

                if (! empty($missingDepartementIds)) {
                    $ref = $imputation->numero;
                    $this->history($imputation->courrier->id, 'Impuatation', "ajout de nouveaux départements à l'imputation N°$ref");
                }

                toastr()->success('Imputation mise à jour avec succès!');
            }
        });

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $imputation): JsonResponse
    {
        $delete = Imputation::findOrFail($imputation);
        $this->journal("Suppression du l'imputation N°$delete->id");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Imputation::with('user', 'subdepartements', 'departements')->onlyTrashed()
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure())
            ->latest('id')->paginate(15);

        return view('imputation.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Imputation::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré l'imputation N°$row->id");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Imputation::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("Suppression definitive de l'imputation N°$row->id");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré tous les imputations');

        return $this->All_restore(Imputation::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vider la corbeille  des imputations');

        return $this->All_remove(Imputation::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->ByStructure()));
    }
}
