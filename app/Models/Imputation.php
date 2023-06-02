<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use App\Helper\DateFormat;
use App\Models\Annotation;
use App\Models\Departement;
use App\Enum\ImputationEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
 * @property int $id
 * @property string $priorite
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Annotation> $annotations
 * @property-read int|null $annotations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation wherePriorite($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Annotation> $annotations
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @method static \Illuminate\Database\Eloquent\Builder|Imputation byStructure()
 * @mixin \Eloquent
 */
class Imputation extends Model
{
    use HasFactory, DateFormat;

    protected $table = 'imputations';

    protected $casts = [
        'etat' => ImputationEnum::class,
    ];

    protected $fillable = ['courrier_id', 'departement_id','user_id', 'reference','fin_traitement','observation','delai','etat'];

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
     * Get the user that owns the Imputation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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
