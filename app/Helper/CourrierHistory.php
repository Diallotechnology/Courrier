<?php
namespace App\Helper;

use App\Models\History;
use Auth;

trait CourrierHistory {

    public function create(int $id, string $action): void
    {
        History::create([
            'user_id' => Auth::user()->id,
            'courrier_id' => $id,
            'action' => $action,
        ]);
    }
}
