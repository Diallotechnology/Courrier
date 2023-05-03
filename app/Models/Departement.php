<?php

namespace App\Models;

use App\Models\User;
use App\Models\Courrier;
use App\Models\Structure;
use App\Helper\DateFormat;
use App\Models\Imputation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Departement extends Model
{
    use HasFactory, DateFormat;

    /**
     * The imputations that belong to the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function imputations(): BelongsToMany
    {
        return $this->belongsToMany(Courrier::class, 'imputations')->withPivot('description');
    }


    /**
     * Get all of the users for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the structure that owns the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * Get all of the tasks for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(Task::class, Imputation::class);
    }
}
