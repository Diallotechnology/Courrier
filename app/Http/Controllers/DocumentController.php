<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Document;
use App\Models\Interne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    use DeleteAction;
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $filePath = public_path($document->DocLink());
        header('Content-Type: application/pdf');
        return response()->file($filePath);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        if($document->type === "Arrivé") {
            $courrier = Courrier::all(['id','reference','numero']);
        }
        if($document->type === "Depart") {
            $courrier = Depart::all(['id','reference','numero']);
        }
        if($document->type === "Interne") {
            $courrier = Interne::all(['id','reference','numero']);
        }
        return view('document.update', compact('document','courrier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'courrier' => 'required',
            'libelle' => 'required',
            'file' => 'nullable|mimes:png,jpg,pdf',
        ]);

        if ($request->hasFile('file')) {
            $this->file_delete($document);
            $filename = $request->file->hashName();

            $directory = 'courrier/' . strtolower($document->type);
            $chemin = $request->file->storeAs($directory, $filename, 'public');
            $documentData = [
                'libelle' => $request->libelle,
                'documentable_id' => $request->courrier,
                'chemin' => $chemin,
            ];

        } else {
           $documentData = [
            'libelle' => $request->libelle,
            'documentable_id' => $request->courrier,
        ];

        }
        $document->update($documentData);
        toastr()->success('Document mise à jour avec succès!');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $document)
    {
        $delete = Document::findOrFail($document);
        // delete document file
        $this->file_delete($delete);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Document::with('documentable')->onlyTrashed()->latest()->paginate(15);
        return view('document.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Document::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Document::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Document::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Document::onlyTrashed());
    }
}
