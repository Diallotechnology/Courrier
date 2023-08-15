<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Annotation;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnnotationController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Annotation::class);
        $request->validate(['nom' => 'required|string|max:150']);
        Annotation::create(['nom' => $request->nom, 'user_id' => Auth::user()->id]);
        toastr()->success('Annotation ajouter avec success!');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annotation $annotation): View
    {
        $this->authorize('update', $annotation);

        return view('annotation.update', compact('annotation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Annotation $annotation): RedirectResponse
    {
        $this->authorize('update', $annotation);
        $data = $request->validate(['nom' => 'required|string|max:150']);
        $annotation->update($data);
        toastr()->success('Annotation mise à jour avec success!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $annotation): JsonResponse
    {
        $delete = Annotation::findOrFail($annotation);

        return $this->supp($delete);
    }

    public function trash(): View
    {
        $rows = Annotation::onlyTrashed()->latest()->paginate(15);

        return view('annotation.trash', compact('rows'));
    }

    public function recover(int $id): JsonResponse
    {

        $row = Annotation::onlyTrashed()->whereId($id)->firstOrFail();

        return $this->Restore($row);
    }

    public function force_delete(int $id): JsonResponse
    {

        $row = Annotation::onlyTrashed()->whereId($id)->firstOrFail();

        return $this->Remove($row);
    }

    public function all_recover(): RedirectResponse
    {

        return $this->All_restore(Annotation::onlyTrashed());
    }

    public function all_delete(): RedirectResponse
    {

        return $this->All_remove(Annotation::onlyTrashed());
    }
}
