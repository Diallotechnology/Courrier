<?php

namespace App\Models;

use App\Enum\ImputationEnum;
use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Imputation
 *
 * @property int $user_id
 * @property int $departement_id
 * @property int $courrier_id
 * @property string|null $delai
 * @property string $reference
 * @property string|null $fin_traitement
 * @property string|null $observation
 * @property ImputationEnum|null $etat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Courrier $courrier
 * @property-read Departement $departement
 *
 * @method static \Database\Factories\ImputationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereDelai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereDepartementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereFinTraitement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation withoutTrashed()
 *
 * @property int $id
 * @property string $priorite
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Annotation> $annotations
 * @property-read int|null $annotations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation wherePriorite($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Annotation> $annotations
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation byStructure()
 *
 * @property int $structure_id
 * @property string|null $numero
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Annotation> $annotations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departement> $departements
 * @property-read int|null $departements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereStructureId($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Annotation> $annotations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Departement> $departements
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 *
 * @mixin \Eloquent
 */
class Imputation extends Model
{
    use DateFormat, HasFactory;

    protected $casts = [
        'etat' => ImputationEnum::class,
    ];

    protected $fillable = [
        'courrier_id',
        'structure_id',
        'user_id',
        'priorite',
        'numero',
        'fin_traitement',
        'observation',
        'delai',
        'etat',
    ];

    /**
     * Get the courrier that owns the Imputation
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }

    /**
     * The departements that belong to the Imputation
     */
    public function departements(): BelongsToMany
    {
        return $this->belongsToMany(Departement::class);
    }

    /**
     * The departements that belong to the Imputation
     */
    public function subdepartements(): BelongsToMany
    {
        return $this->belongsToMany(SubDepartement::class);
    }

    /**
     * Get the user that owns the Imputation
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the annotations for the Imputation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annotations(): BelongsToMany
    {
        return $this->belongsToMany(Annotation::class);
    }

    /**
     * Get all of the task for the Imputation
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function Complet(): bool
    {
        return $this->etat == ImputationEnum::TERMINE;
    }

    public function Pending(): bool
    {
        return $this->etat == ImputationEnum::EN_ATTENTE;
    }

    public function Progress(): bool
    {
        return $this->etat == ImputationEnum::EN_COURS;
    }
}
