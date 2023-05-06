<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Annotation;
use Auth;
use Illuminate\Http\Request;

class AnnotationController extends Controller
{

    use DeleteAction;
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nom'=>'required|string|max:150']);
        Annotation::create(['nom'=> $request->nom, 'user_id' => Auth::user()->id]);
        toastr()->success('Annotation ajouter avec success!');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Annotation $annotation)
    {
        return view('annotation.update', compact('annotation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annotation $annotation)
    {
        $data = $request->validate(['nom'=>'required|string|max:150']);
        $annotation->update($data);
        toastr()->success('Annotation mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $annotation)
    {
        $delete = Annotation::findOrFail($annotation);
        return  $this->supp($delete);
    }
}
