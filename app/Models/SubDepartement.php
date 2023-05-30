<?php

namespace App\Models;

use App\Models\User;
use App\Helper\DateFormat;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @mixin \Eloquent
 */
class SubDepartement extends Model
{
    use HasFactory, DateFormat;

    /**
     * Get the departement that owns the SubDepartement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class);
    }

    /**
     * Get all of the user for the Departement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): MorphMany
    {
        return $this->morphMany(User::class,'userable');
    }
}
