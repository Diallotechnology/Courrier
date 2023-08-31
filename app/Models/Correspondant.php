<?php

namespace App\Models;

use App\Models\Depart;
use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Correspondant
 *
 * @property int $id
 * @property int $structure_id
 * @property string $prenom
 * @property string $nom
 * @property string $fonction
 * @property string $phone
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read int|null $courriers_count
 * @property-read Structure $structure
 *
 * @method static \Database\Factories\CorrespondantFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereFonction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant withoutTrashed()
 *
 * @property string|null $contact
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Correspondant whereContact($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read int|null $departs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read string $date_format
 *
 * @method static Builder|Correspondant byStructure()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 *
 * @mixin \Eloquent
 */
class Correspondant extends Model
{
    use HasFactory, DateFormat;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom', 'fonction', 'contact', 'email', 'structure_id'];

    /**
     * Get the structure that owns the Correspondant
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * Get all of the courriers for the Correspondant
     */
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }

    /**
     * The departs that belong to the Correspondant
     */
    public function departs(): BelongsToMany
    {
        return $this->belongsToMany(Depart::class);
    }
}
