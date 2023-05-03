<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use App\Models\Depart;
use App\Models\Nature;
use App\Models\History;
use App\Models\Rapport;
use App\Models\Document;
use App\Helper\DateFormat;
use App\Models\Departement;
use App\Models\Correspondant;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Courrier extends Model
{
    use HasFactory, DateFormat;

    protected function getCreatedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format('d/m/Y');
    }

    protected function getDeletedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format('d/m/Y H:m:s');
    }

    // public function getExpirationFormatAttribute(): string
    // {
    //     return Carbon::parse($this->expiration)->format('d/m/Y');
    // }


        /**
     * Get all of the document's Courrier.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get the nature that owns the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }

    /**
     * Get the user that owns the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the rapports for the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rapports(): HasMany
    {
        return $this->hasMany(Rapport::class);
    }

    /**
     * The imputations that belong to the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function imputations(): BelongsToMany
    {
        return $this->belongsToMany(Departement::class, 'imputations')->withPivot('description');
    }

    /**
     * Get the correspondant that owns the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function correspondant(): BelongsTo
    {
        return $this->belongsTo(Correspondant::class);
    }

    /**
     * Get all of the tasks for the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }


    /**
     * Get all of the departs for the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departs(): HasMany
    {
        return $this->hasMany(Depart::class);
    }

    /**
     * Get all of the histories for the Courrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }



}
