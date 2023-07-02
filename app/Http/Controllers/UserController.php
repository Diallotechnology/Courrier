<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegisterMail;
use App\Models\Departement;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;
use App\Models\SubDepartement;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Jobs\MailJob;

class UserController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validate = $request->validated();
        if ($validate['type'] === 'departement') {
            $parent = Departement::findOrFail($validate['userable_id']);
        } elseif ($validate['type'] === 'subdepartement') {
            $parent = SubDepartement::findOrFail($validate['userable_id']);
        }
        $user = $parent->users()->create($request->safe()->except(['userable_id']));
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
        $rows = User::with('departement')->withCount('imputations')->onlyTrashed()
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
