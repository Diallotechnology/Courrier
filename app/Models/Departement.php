<?php

namespace App\Models;

use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Departement
 *
 * @property int $id
 * @property string $nom
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $imputations
 * @property-read int|null $imputations_count
 * @property-read Structure $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 *
 * @method static \Database\Factories\DepartementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Departement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Departement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Departement withoutTrashed()
 *
 * @property int $structure_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Departement whereStructureId($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, SubDepartement> $subdepartement
 * @property-read int|null $subdepartement_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, SubDepartement> $subdepartements
 * @property-read int|null $subdepartements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Departement byStructure()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubDepartement> $subdepartements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubDepartement> $subdepartements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 *
 * @mixin \Eloquent
 */
class Departement extends Model
{
    use HasFactory, DateFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom', 'structure_id', 'code'];

    /**
     * Get all of the user for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): MorphMany
    {
        return $this->morphMany(User::class, 'userable');
    }

    /**
     * The utilisateurs that belong to the Departement
     */
    public function utilisateurs(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('type');
    }

    /**
     * Get the structure that owns the Departement
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * Get all of the subdepartement for the Departement
     */
    public function subdepartements(): HasMany
    {
        return $this->hasMany(SubDepartement::class);
    }

    /**
     * The imputations that belong to the Departement
     */
    public function imputations(): BelongsToMany
    {
        return $this->belongsToMany(Imputation::class);
    }

    /**
     * Get all of the tasks for the Departement
     */
    public function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(Task::class, Imputation::class);
    }
}
