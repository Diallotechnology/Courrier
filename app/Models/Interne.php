<?php

namespace App\Models;

use App\Models\User;
use App\Models\Document;
use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Interne
 *
 * @property int $id
 * @property int $user_id
 * @property int $nature_id
 * @property int $expediteur_id
 * @property int $destinataire_id
 * @property string|null $delai
 * @property string $reference
 * @property string $numero
 * @property string $objet
 * @property string $priorite
 * @property string $confidentiel
 * @property string|null $contenu
 * @property string|null $etat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $destinataire
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read int|null $documents_count
 * @property-read User $expediteur
 * @property-read User $user
 * @method static \Database\Factories\InterneFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Interne newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne query()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereConfidentiel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereDelai($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereDestinataireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereEtat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereExpediteurId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereNatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereObjet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne wherePriorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Interne withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Interne withoutTrashed()
 * @mixin \Eloquent
 */
class Interne extends Model
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
        'expediteur_id',
        'destinataire_id',
        'reference',
        'numero',
        'objet',
        'priorite',
        'confidentiel',
        'observation',
        'etat',
        'date',
        'delai',
        'contenu'
    ];

    /**
     * Get the expediteur that owns the Interne
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function expediteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    /**
     * Get the destinataire that owns the Interne
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinataire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'destinataire_id');
    }

    /**
     * Get the user that owns the Interne
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

            /**
     * Get all of the document's Interne.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

}
