<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Imputation;
use Illuminate\Http\Request;

class ImputationController extends Controller
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
    public function show(Imputation $imputation)
    {
        return view('imputation.show', compact('imputation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imputation $imputation)
    {
        return view('imputation.update', compact('imputation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imputation $imputation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $imputation)
    {
        $delete = Imputation::findOrFail($imputation);
        return  $this->supp($delete);
    }

    public function trash()
    {
        $rows = Imputation::with('user')->onlyTrashed()->latest()->paginate(15);
        return view('imputation.trash', compact('rows'));
    }

    public function recover(int $id) {

        $row = Imputation::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Restore($row);
    }

    public function force_delete(int $id) {

        $row = Imputation::onlyTrashed()->whereId($id)->firstOrFail();
        return $this->Remove($row);
    }


    public function all_recover() {

        return $this->All_restore(Imputation::onlyTrashed());
    }

    public function all_delete() {

        return $this->All_remove(Imputation::onlyTrashed());
    }
}
