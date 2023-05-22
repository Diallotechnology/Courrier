<?php

namespace App\Http\Controllers;

use App\Enum\CourrierInterneEnum;
use App\Models\User;
use App\Models\Nature;
use App\Models\Interne;
use App\Models\Document;
use App\Helper\DeleteAction;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInterneRequest;
use App\Http\Requests\UpdateInterneRequest;
use App\Notifications\CourrierNotification;
use Illuminate\Support\Facades\Notification;

class InterneController extends Controller
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
        $user = User::with('departement')->where('departement_id',Auth::user()->departement_id)->get()->groupBy('departement.nom');
        $type = Nature::orderBy('nom')->get();
        return view('interne.create', compact('user','type'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreInterneRequest $request) {
    foreach ($request->destinataire_id as $value) {
        $itemData = [
            "objet" => $request->objet,
            "confidentiel" => $request->confidentiel,
            "priorite" => $request->priorite,
            "contenu" => $request->contenu,
            "etat" => $request->etat,
            "nature_id" => $request->nature_id,
            "user_id" => $request->user_id,
            "destinataire_id" => $value,
            "expediteur_id" => $request->expediteur_id,
        ];

        $item = Interne::create($itemData);
        $item->generateId('CI');

        $user = User::whereId($value)->first(['email','id']);

        $notification = new CourrierNotification($item, "Vous avez reçu un nouveau courrier interne");
        // Notification::route('mail', $emails)->notify($notification);
        $user->notify($notification);
    }

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $key => $row) {
            $filename = $row->hashName();
            $chemin = $row->storeAs('courrier/interne', $filename, 'public');
            $data = new Document([
                'libelle' => $row->getClientOriginalName(),
                'type' => 'Interne',
                'user_id' => Auth::user()->id,
                'chemin' => $chemin,
            ]);
            $item->documents()->save($data);
        }
    }

    toastr()->success('Courrier envoyé avec succès!');
    return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(Interne $interne)
    {
        if($interne->Recu()) {

            $interne->update(['etat' => CourrierInterneEnum::READ]);
        }
        return view('interne.show', compact('interne'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interne $interne)
    {
        $user = User::with('departement')->where('departement_id',Auth::user()->departement_id)->get()->groupBy('departement.nom');
        $type = Nature::orderBy('nom')->get();
        return view('interne.update', compact('interne','user','type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInterneRequest $request, Interne $interne)
    {
        $interne->update($request->validated());
        if ($request->hasFile('files')):
            foreach ($request->file('files') as $key => $row):
                // renome le document
                $filename =  $row->hashName();
                $chemin = $row->storeAs('courrier/interne', $filename, 'public');
                $data = new Document([
                    'libelle' => $row->getClientOriginalName(),
                    'user_id' => Auth::user()->id,
                    'type' => 'Interne',
                    'chemin' => $chemin,
                ]);
                $interne->documents()->save($data);
            endforeach;
        endif;
        toastr()->success('Courrier mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $interne)
    {
        $delete = Interne::findOrFail($interne);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Interne::with('user','nature','destinataire','expediteur')->onlyTrashed()->latest()->paginate(15);
        return view('interne.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Interne::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Interne::onlyTrashed()->whereId($id)->firstOrFail();
        if($row->documents) {
            foreach($row->documents as $item) {
                $this->file_delete($item);
            }
        }
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Interne::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Interne::onlyTrashed());
    }
}
