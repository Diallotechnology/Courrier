<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Models\User;
use App\Notifications\ReponseNotification;
use Illuminate\Http\Request;

class ReponseController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message'=>'required|string',
            'interne_id'=>'required',
            'expediteur_id'=>'required'
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
     * Display the specified resource.
     */
    public function show(Reponse $reponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reponse $reponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reponse $reponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reponse $reponse)
    {
        //
    }
}
