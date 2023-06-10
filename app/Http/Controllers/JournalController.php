<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    use DeleteAction;

    /**
     * Display the specified resource.
     */
    public function show(Journal $journal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $journal)
    {
        $delete = Journal::findOrFail($journal);
        return  $this->supp($delete);
    }
}
