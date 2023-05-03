<?php

namespace App\Models;

use App\Models\Task;
use App\Helper\DateFormat;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imputation extends Model
{
    use HasFactory, DateFormat;

    protected $table = 'imputations';
    public $incrementing = false;

    // protected $fillable = ['courrier_id', 'departement_id', 'description'];

    /**
     * Get the courrier that owns the Imputation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }

    /**
     * Get the departement that owns the Imputation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Get all of the tasks for the Imputation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function tasks(): HasMany
    // {
    //     return $this->hasMany(Task::class);
    // }
}
