<?php

namespace App\Models;

use App\Models\User;
use App\Models\Nature;
use App\Models\Courrier;
use App\Models\Document;
use App\Helper\DateFormat;
use App\Models\Correspondant;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Depart
 *
 * @property int $id
 * @property int $user_id
 * @property int $nature_id
 * @property int|null $courrier_id
 * @property int $correspondant_id
 * @property string $reference
 * @property string $numero
 * @property string $objet
 * @property string $priorite
 * @property string $confidentiel
 * @property string|null $observation
 * @property string|null $etat
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Courrier|null $courrier
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read int|null $documents_count
 * @property-read User $user
 * @method static \Database\Factories\DepartFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Depart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart query()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereConfidentiel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereCorrespondantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereNatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereObjet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereObservation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart wherePriorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Depart withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Depart withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @mixin \Eloquent
 */
class Depart extends Model
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
        'courrier_id',
        'correspondant_id',
        'reference',
        'numero',
        'objet',
        'priorite',
        'confidentiel',
        'observation',
        'etat',
        'date'
    ];

    public function getDateFormatAttribute(): string
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }

    /**
     * Get the user that owns the Depart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

        /**
     * Get all of the document's Depart.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get the courrier that owns the Depart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }

    /**
     * Get the nature that owns the Depart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nature(): BelongsTo
    {
        return $this->belongsTo(Nature::class);
    }

    /**
     * Get the correspondant that owns the Depart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function correspondant(): BelongsTo
    {
        return $this->belongsTo(Correspondant::class);
    }



}
