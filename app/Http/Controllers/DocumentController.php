<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Courrier;
use App\Models\Depart;
use App\Models\Document;
use App\Models\Interne;
use App\Models\Rapport;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DocumentController extends Controller
{
    use DeleteAction;

    /**
     * Display the specified resource.
     */
    public function show(Document $document): BinaryFileResponse
    {
        $filePath = public_path($document->DocLink());
        header('Content-Type: application/pdf');
        $this->journal("Consulté le document N°$document->id");

        return response()->file($filePath);
    }

    public function download(Document $document)
    {
        $filePath = public_path($document->DocLink());
        $this->journal("telecharger le document N°$document->id");

        return response()->download($filePath);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document): View
    {
        return view('document.update', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document): RedirectResponse
    {
        $request->validate([
            'type' => 'required',
            'libelle' => 'required',
            'file' => 'nullable',
        ]);
        $path = '';

        if ($document->documentable instanceof Interne) {
            $path = 'courrier/interne';
        } elseif ($document instanceof Courrier) {
            $path = 'courrier/arrive';
        } elseif ($document instanceof Rapport) {
            $path = 'rapport';
        } elseif ($document instanceof Depart) {
            $path = 'courrier/depart';
        }
        if ($request->hasFile('file')) {
            $this->file_delete($document);
            $filename = $request->file->hashName();
            $chemin = $request->file->storeAs($path, $filename, 'public');
            $documentData = ['chemin' => $chemin];
            $this->journal("Mise a jour le fichier du document N°$document->id");
        } else {
            $documentData = ['libelle' => $request->libelle];
        }
        $document->update($documentData);
        toastr()->success('Document mise à jour avec succès!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $document): JsonResponse
    {
        $delete = Document::findOrFail($document);
        $this->journal("Suppression du document N°$delete->id");

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Document::with('documentable')->onlyTrashed()->latest()->paginate(15);

        return view('document.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Document::onlyTrashed()->whereId($id)->firstOrFail();
        $this->journal("restauré le document N°$row->id");

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {
        $row = Document::onlyTrashed()->whereId($id)->firstOrFail();
        $this->file_delete($row);
        $this->journal("Suppression definitive du document N°$row->id");

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {
        $this->journal('Restauré tous les documents');

        return $this->All_restore(Document::onlyTrashed());
    }

    public function all_delete(): RedirectResponse
    {
        $this->journal('Vider la corbeille  des documents');

        return $this->All_remove(Document::onlyTrashed());
    }
}
