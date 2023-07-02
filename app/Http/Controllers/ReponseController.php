<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reponse;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Notifications\ReponseNotification;

class ReponseController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'message' => 'required|string',
            'interne_id' => 'required',
            'expediteur_id' => 'required',
        ]);
        Reponse::create([
            'message' => $request->message,
            'user_id' => auth()->user()->id,
            'interne_id' => $request->interne_id,
        ]);
        $user = User::find($request->expediteur_id);
        $user->notify(new ReponseNotification("$user->name a envoyer une reponse"));
        toastr()->success('Reponse envoyé avec success!');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reponse $reponse): View
    {
        $this->authorize('update', $reponse);

        return view('reponse.update', compact('reponse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reponse $reponse): RedirectResponse
    {
        $this->authorize('update', $reponse);
        $request->validate([
            'message' => 'required|string',
        ]);
        $reponse->update(['message' => $request->message]);
        toastr()->success('Reponse mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $reponse): JsonResponse
    {
        $delete = Reponse::findOrFail($reponse);
        $this->journal("Suppression de la reponse N°$delete->id");

        return $this->supp($delete);
    }
}
