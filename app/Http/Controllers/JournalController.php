<?php

namespace App\Http\Controllers;

use App\Helper\DeleteAction;
use App\Models\Journal;
use Illuminate\Http\JsonResponse;

class JournalController extends Controller
{
    use DeleteAction;

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $journal): JsonResponse
    {
        $delete = Journal::findOrFail($journal);

        return $this->supp($delete);
    }
}
