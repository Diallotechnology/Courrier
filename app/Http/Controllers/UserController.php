<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\MailJob;
use App\Models\Departement;
use App\Models\SubDepartement;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validate = $request->validated();
        $departementIds = $request->input('departement_id');
        $subdepartementIds = $request->input('subdepartement_id');
        if ($validate['type'] === 'departement') {
            $parent = Departement::findOrFail($validate['userable_id']);
        } elseif ($validate['type'] === 'subdepartement') {
            $parent = SubDepartement::findOrFail($validate['userable_id']);
        }
        $user = $parent->users()->create($request->safe()->except(['userable_id', 'departement_id', 'subdepartement_id']));
        if (! $user->isStandard()) {
            // user zone imputation
            $departementIds = ! empty($departementIds) ? $user->departements()->attach($departementIds, ['type' => 'division']) : '';
            $subdepartementIds = ! empty($subdepartementIds) ? $user->departements()->attach($subdepartementIds, ['type' => 'sub_division']) : '';
        }
        MailJob::dispatch($user);
        toastr()->success('Utilisateur ajouter avec success!');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        $this->authorize('view', $user);
        $courrier = $user->courriers()->paginate(10);
        $imputation = $user->imputations()->paginate(10);

        return view('user.show', compact('user', 'courrier', 'imputation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $this->authorize('update', $user);
        $departement = $user->isSuperadmin() ?
         Departement::all(['id', 'nom']) : Departement::byStructure()->get();

        return view('user.update', compact('user', 'departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validate = $request->validated();
        $departementIds = $request->input('departement_id');
        $subdepartementIds = $request->input('subdepartement_id');
        if (Auth::user()->isAdmin() || Auth::user()->isSuperadmin()) {
            if ($validate['type'] === 'departement') {
                $parent = Departement::findOrFail($validate['userable_id']);
            } elseif ($validate['type'] === 'subdepartement') {
                $parent = SubDepartement::findOrFail($validate['userable_id']);
            }
            $user->userable()->dissociate();
            $user->userable()->associate($parent);
            if (! $user->isStandard()) {
                // user zone imputation
                $departementIds = ! empty($departementIds) ? $user->departements()->syncWithPivotValues($departementIds, ['type' => 'division']) : '';
                $subdepartementIds = ! empty($subdepartementIds) ? $user->departements()->syncWithPivotValues($subdepartementIds, ['type' => 'sub_division']) : '';
            }

        }
        $user->update($request->validated());

        toastr()->success('Utilisateur mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user): JsonResponse
    {
        $delete = User::findOrFail($user);
        $this->file_delete($delete);

        return $this->supp($delete);
    }

    public function active_2fa(Request $request): RedirectResponse
    {
        $value = $request->two_factor === 'on' ? 1 : 0;
        User::findOrFail($request->id)->updateOrFail(['two_factor_enabled' => $value]);
        toastr()->success(' L’authentification à deux facteurs activé avec success!');

        return back();
    }

    public function trash(): View
    {
        $rows = User::with('userable')->withCount('imputations')->onlyTrashed()
            ->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->StructureUser())
            ->latest()->paginate(15);

        return view('user.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = User::onlyTrashed()->whereId($id)->firstOrFail();

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {
        $row = User::onlyTrashed()->whereId($id)->firstOrFail();

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {

        return $this->All_restore(User::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->StructureUser()));
    }

    public function all_delete(): RedirectResponse
    {
        return $this->All_remove(User::onlyTrashed()->when(! Auth::user()->isSuperadmin(), fn ($query) => $query->StructureUser()));
    }
}
