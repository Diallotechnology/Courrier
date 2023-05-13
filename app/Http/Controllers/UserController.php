<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enum\RoleEnum;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class UserController extends Controller
{
    use DeleteAction;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'poste' => ['required', 'string', 'max:150'],
            'role' => ['required', new Enum(RoleEnum::class)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'poste' => $request->poste,
            'photo' => $request->poste,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.update', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
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
