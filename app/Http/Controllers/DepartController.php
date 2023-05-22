<?php

namespace App\Http\Controllers;

use App\Models\Depart;
use App\Models\Nature;
use App\Models\Courrier;
use App\Models\Document;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;
use App\Models\Correspondant;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDepartRequest;
use App\Http\Requests\UpdateDepartRequest;

class DepartController extends Controller
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
    public function store(StoreDepartRequest $request)
    {
        $item = Depart::create($request->validated());
        $item->generateId('CD');
        if ($request->hasFile('files')):
            foreach ($request->file('files') as $key => $row):
                // renome le document
                $filename =  $row->hashName();
                $chemin = $row->storeAs('courrier/depart', $filename, 'public');
                $data = new Document([
                    'libelle' => $row->getClientOriginalName(),
                    'user_id' => Auth::user()->id,
                    'type' => 'Depart',
                    'chemin' => $chemin,
                ]);
                $item->documents()->save($data);
            endforeach;
        endif;
        toastr()->success('Courrier ajouter avec success!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Depart $depart)
    {
        return view('depart.show', compact('depart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depart $depart)
    {
        $correspondant = Correspondant::orderBy('nom')->get();
        $type = Nature::orderBy('nom')->get();
        $courrier = Courrier::with('nature','correspondant')->latest()->get(['id','numero','reference','date']);
        return view('depart.update', compact('depart','correspondant','type','courrier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartRequest $request, Depart $depart)
    {
        $depart->update($request->validated());
        if ($request->hasFile('files')):
            foreach ($request->file('files') as $key => $row):
                // renome le document
                $filename =  $row->hashName();
                $chemin = $row->storeAs('courrier/depart', $filename, 'public');
                $data = new Document([
                    'libelle' => $row->getClientOriginalName(),
                    'user_id' => Auth::user()->id,
                    'type' => 'Depart',
                    'chemin' => $chemin,
                ]);
                $depart->documents()->save($data);
            endforeach;
        endif;
        toastr()->success('Courrier mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $depart)
    {
        $delete = Depart::findOrFail($depart);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Depart::with('user','courrier')->onlyTrashed()->latest()->paginate(15);
        return view('depart.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Depart::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Depart::onlyTrashed()->whereId($id)->firstOrFail();
        if($row->documents) {
            foreach($row->documents as $item) {
                $this->file_delete($item);
            }
        }
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Depart::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Depart::onlyTrashed());
    }
}
