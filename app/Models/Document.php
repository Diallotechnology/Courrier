<?php

namespace App\Models;

use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory, DateFormat;

    /**
     * Get the parent documentable model (Courrier or Depart, Interne).
     */
    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }

}
