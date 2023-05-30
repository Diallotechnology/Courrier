<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helper\DeleteAction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserRequest;
use App\Mail\RegisterMail;
use App\Models\Departement;

class UserController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());
        Mail::to($user->email)->send(new RegisterMail($user));
        toastr()->success('Utilisateur ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $departement = Departement::all();
        return view('user.update', compact('user','departement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user)
    {
        $user->update($request->validated());
        toastr()->success('Utilisateur mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user)
    {
        $delete = User::findOrFail($user);
        $this->file_delete($delete);
        return  $this->supp($delete);
    }


    public function trash()
    {
        $rows = User::with('departement')->withCount('imputations')->onlyTrashed()->latest()->paginate(15);
        return view('user.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = User::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {
        $row = User::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(User::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(User::onlyTrashed());
    }
}
