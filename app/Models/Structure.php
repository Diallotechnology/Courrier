<?php

namespace App\Models;

use App\Enum\StructureTypeEnum;
use App\Models\Licence;
use App\Helper\DateFormat;
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
 *
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
 *
 * @property string $adresse
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departements
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereAdresse($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read int|null $rapports_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, SubStructure> $substructures
 * @property-read int|null $substructures_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read int|null $courriers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $departements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read int|null $departs_count
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Journal> $jourals
 * @property-read int|null $jourals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Nature> $natures
 * @property-read int|null $natures_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $users
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Structure byStructure()
 *
 * @property string $code
 * @property string|null $expire_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departement> $departements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read int|null $imputations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Journal> $jourals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Nature> $natures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Structure whereExpireAt($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Correspondant> $correspondants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departement> $departements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Journal> $jourals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Nature> $natures
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 *
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
    protected $fillable = ['nom', 'code', 'email', 'logo', 'contact', 'description', 'adresse'];

        /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => StructureTypeEnum::class,
    ];

    /**
     * Get all of the correspondants for the Structure
     */
    public function correspondants(): HasMany
    {
        return $this->hasMany(Correspondant::class);
    }

    /**
     * Get all of the departements for the Structure
     */
    public function departements(): HasMany
    {
        return $this->hasMany(Departement::class);
    }

    /**
     * Get all of the users for the Structure
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Departement::class, 'structure_id', 'userable_id', 'id', 'id');
    }

    /**
     * Get all of the rapports for the Structure
     */
    public function rapports(): HasMany
    {
        return $this->hasMany(Rapport::class);
    }

    /**
     * Get all of the courriers for the Structure
     */
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }

    /**
     * Get all of the natures for the Structure
     */
    public function natures(): HasMany
    {
        return $this->hasMany(Nature::class);
    }

    /**
     * Get all of the departs for the Structure
     */
    public function departs(): HasMany
    {
        return $this->hasMany(Depart::class);
    }

    /**
     * Get all of the imputations for the Structure
     */
    public function imputations(): HasMany
    {
        return $this->hasMany(Imputation::class);
    }

    /**
     * Get all of the licences for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function licences(): HasMany
    {
        return $this->hasMany(Licence::class);
    }

    /**
     * Get all of the documents for the Structure
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get all of the jourals for the Structure
     */
    public function jourals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }

    public function DocLink(): string
    {
        return Storage::url($this->logo);
    }

    public function isExpired()
    {
        return $this->expire_at < now();
    }
}
