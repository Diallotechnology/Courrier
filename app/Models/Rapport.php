<?php

namespace App\Models;

use App\Models\User;
use App\Models\Courrier;
use App\Models\Document;
use App\Models\Structure;
use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Rapport
 *
 * @property int $id
 * @property int $user_id
 * @property int $courrier_id
 * @property string $nom
 * @property string $type
 * @property string|null $contenu
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Courrier $courrier
 * @property-read User $user
 * @method static \Database\Factories\RapportFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport withoutTrashed()
 * @property int $structure_id
 * @property string|null $reference
 * @property string $objet
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Document> $documents
 * @property-read int|null $documents_count
 * @property-read Structure $structure
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereObjet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rapport whereStructureId($value)
 * @mixin \Eloquent
 */
class Rapport extends Model
{
    use HasFactory, DateFormat;

    const TYPE = [
        "Rapport d'activité",
        "Rapport financier",
        "Rapport de vente",
        "Rapport de mission",
        "Rapport de marketing",
        "Rapport de gestion des ressources humaines",
        "Rapport de recherche et développement",
        "Rapport de gestion de projet",
        "Rapport de qualité",
        "Rapport de gestion environnementale",
        "Rapport annuel",
        "Rapport de performance",
        "Rapport de conformité",
        "Rapport d'audit",
        "Rapport de transparence",
        "Rapport de gestion des risques",
        "Rapport d'évaluation des politiques publiques",
        "Rapport de gestion des actifs publics",
        "Rapport de conformité financière",
        "Autres",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['objet','user_id','type','contenu','courrier_id','structure_id'];

    /**
     * Get the user that owns the Rapport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the courrier that owns the Rapport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }

    /**
     * Get all of the document's Rapport.
     */
    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Get the structure that owns the Rapport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }
}
