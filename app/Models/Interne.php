<?php

namespace App\Models;

use App\Models\User;
use App\Models\Document;
use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interne extends Model
{
    use HasFactory, DateFormat;

    /**
     * Get the expediteur that owns the Interne
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expediteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    /**
     * Get the destinataire that owns the Interne
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinataire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }

    /**
     * Get the user that owns the Interne
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

            /**
     * Get all of the document's Interne.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

}
