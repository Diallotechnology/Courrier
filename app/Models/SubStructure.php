<?php

namespace App\Models;

use App\Models\User;
use App\Models\Structure;
use App\Helper\DateFormat;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Models\SubStructure
 *
 * @property int $id
 * @property int $structure_id
 * @property string $nom
 * @property string|null $logo
 * @property string|null $email
 * @property string $contact
 * @property string $adresse
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departments
 * @property-read int|null $departments_count
 * @property-read Structure $structure
 * @method static \Database\Factories\SubStructureFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubStructure withoutTrashed()
 * @mixin \Eloquent
 */
class SubStructure extends Model
{
    use HasFactory, DateFormat;

    /**
     * Get the structure that owns the SubStructure
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * Get all of the departments for the SubStructure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Departement::class);
    }

}
