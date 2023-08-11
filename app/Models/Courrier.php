<?php

namespace App\Models;

use App\Enum\CourrierEnum;
use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Courrier
 *
 * @property int $id
 * @property int $user_id
 * @property int $nature_id
 * @property int $correspondant_id
 * @property string $reference
 * @property string $numero
 * @property string $objet
 * @property string $priorite
 * @property string $confidentiel
 * @property string|null $observation
 * @property CourrierEnum|null $etat
 * @property string $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Correspondant $correspondant
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read int|null $departs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read int|null $documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, History> $histories
 * @property-read int|null $histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $imputations
 * @property-read int|null $imputations_count
 * @property-read Nature $nature
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read int|null $rapports_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read int|null $tasks_count
 * @property-read User $user
 *
 * @method static \Database\Factories\CourrierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereConfidentiel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereCorrespondantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereNatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereObjet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier wherePriorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier withoutTrashed()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 * @property int $structure_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Departement> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Rapport> $rapports
 * @property-read Structure $structure
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $tasks
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier byStructure()
 * @method static \Illuminate\Database\Eloquent\Builder|Courrier whereStructureId($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rapport> $rapports
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\History> $histories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Imputation> $imputations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Rapport> $rapports
 *
 * @mixin \Eloquent
 */
class Courrier extends Model
{
    use HasFactory, DateFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nature_id',
        'structure_id',
        'correspondant_id',
        'reference',
        'numero',
        'objet',
        'priorite',
        'confidentiel',
        'observation',
        'etat',
        'date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'etat' => CourrierEnum::class,
        'date' => 'date',
    ];

    /**
     * Get the courrier's folder.
     */
    public function folder(): MorphOne
    {
        return $this->morphOne(Folder::class, 'folderable');
    }

    /**
     * Get the nature that owns the Courrier
     */
    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }

    /**
     * Get the user that owns the Courrier
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the rapports for the Courrier
     */
    public function rapports(): HasMany
    {
        return $this->hasMany(Rapport::class);
    }

    /**
     * Get all of the imputations for the Courrier
     */
    public function imputations(): HasMany
    {
        return $this->hasMany(Imputation::class);
    }

    /**
     * Get the correspondant that owns the Courrier
     */
    public function correspondant(): BelongsTo
    {
        return $this->belongsTo(Correspondant::class);
    }

    /**
     * Get the structure that owns the Courrier
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * Get all of the departs for the Courrier
     */
    public function departs(): HasMany
    {
        return $this->hasMany(Depart::class);
    }

    /**
     * Get all of the histories for the Courrier
     */
    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }

    public function Complet(): bool
    {
        return $this->etat == CourrierEnum::TERMINE;
    }

    public function Impute(): bool
    {
        return $this->etat == CourrierEnum::IMPUTE;
    }

    public function Progress(): bool
    {
        return $this->etat == CourrierEnum::PROCESS;
    }

    public function Register(): bool
    {
        return $this->etat == CourrierEnum::SAVE;
    }

    public function Archive(): bool
    {
        return $this->etat == CourrierEnum::ARCHIVE;
    }
}
