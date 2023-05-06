<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use App\Helper\DeleteAction;
use Illuminate\Http\Request;


/**
 *
 */
class NatureController extends Controller
{
    use DeleteAction;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate(['nom'=>'required|string|max:100']);
        Nature::create($data);
        toastr()->success('Nature ajouter avec success!');
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nature $nature)
    {
        return view('nature.update', compact('nature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nature $nature)
    {

        $data = $request->validate(['nom'=>'required|string|max:100']);
        $nature->update($data);
        toastr()->success('Nature mise à jour avec success!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $nature)
    {

        $delete = Nature::findOrFail($nature);
        return  $this->supp($delete);
    }
}
