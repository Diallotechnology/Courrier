<?php

namespace App\Models;

use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\SubDepartement
 *
 * @property int $id
 * @property int $departement_id
 * @property string $nom
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Departement $departement
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 *
 * @method static \Database\Factories\SubDepartementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement whereDepartementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement withoutTrashed()
 *
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SubDepartement byStructure()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 *
 * @mixin \Eloquent
 */
class SubDepartement extends Model
{
    use HasFactory, DateFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['departement_id', 'nom', 'code'];

    /**
     * Get the departement that owns the SubDepartement
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * The imputations that belong to the Departement
     */
    public function imputations(): BelongsToMany
    {
        return $this->belongsToMany(Imputation::class);
    }

    /**
     * Get all of the user for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): MorphMany
    {
        return $this->morphMany(User::class, 'userable');
    }
}
