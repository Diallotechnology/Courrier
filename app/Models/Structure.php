<?php

namespace App\Models;

use App\Models\User;
use App\Models\Depart;
use App\Models\Nature;
use App\Models\Rapport;
use App\Models\Courrier;
use App\Helper\DateFormat;
use App\Models\Departement;
use App\Models\SubStructure;
use App\Models\Correspondant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read int|null $rapports_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, SubStructure> $substructures
 * @property-read int|null $substructures_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
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

    /**
     * Get all of the users for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Departement::class,'structure_id','userable_id','id','id');
    }

    /**
     * Get all of the rapports for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rapports(): HasMany
    {
        return $this->hasMany(Rapport::class);
    }

    /**
     * Get all of the courriers for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }


    /**
     * Get all of the natures for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function natures(): HasMany
    {
        return $this->hasMany(Nature::class);
    }

    /**
     * Get all of the departs for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departs(): HasMany
    {
        return $this->hasMany(Depart::class);
    }


    public function DocLink(): string {

        return Storage::url($this->logo);
    }
}
