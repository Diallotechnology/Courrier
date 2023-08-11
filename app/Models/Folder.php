<?php

namespace App\Models;

use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Folder extends Model
{
    use HasFactory, DateFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom', 'type', 'structure_id', 'folderable_id', 'folderable_type'];

    /**
     * Get the parent folderable model (Courrier or Depart, Interne).
     */
    public function folderable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the structure that owns the Document
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * Get all of the documents for the Folder
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    public function IsCourrier(): bool
    {
        return $this->folderable_type === Courrier::class;
    }

    public function IsInterne(): bool
    {
        return $this->folderable_type === Interne::class;
    }

    public function IsRapport(): bool
    {
        return $this->folderable_type === Rapport::class;
    }

    public function IsDepart(): bool
    {
        return $this->folderable_type === Depart::class;
    }
}
