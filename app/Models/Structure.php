<?php

namespace App\Models;

use App\Helper\DateFormat;
use App\Models\Departement;
use App\Models\Correspondant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Structure
 *
 * @property int $id
 * @property string $nom
 * @property string|null $logo
 * @property string|null $email
 * @property string $contact
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Correspondant> $correspondants
 * @property-read int|null $correspondants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departements
 * @property-read int|null $departements_count
 * @method static \Database\Factories\StructureFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Structure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure query()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Structure withoutTrashed()
 * @property string $adresse
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departements
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereAdresse($value)
 * @mixin \Eloquent
 */
class Structure extends Model
{
    use HasFactory, DateFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom','email','logo','contact','description','adresse'];

    /**
     * Get all of the correspondants for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function correspondants(): HasMany
    {
        return $this->hasMany(Correspondant::class);
    }

    /**
     * Get all of the departements for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departements(): HasMany
    {
        return $this->hasMany(Departement::class);
    }

    public function DocLink(): string {

        return Storage::url($this->logo);
    }
}
