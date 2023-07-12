<?php

namespace App\Models;

use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Nature
 *
 * @property int $id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read int|null $courriers_count
 *
 * @method static \Database\Factories\NatureFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Nature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nature withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Nature withoutTrashed()
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read int|null $departs_count
 * @property string $structure_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Depart> $departs
 * @property-read string $date_format
 * @property-read Structure $structure
 *
 * @method static Builder|Nature byStructure()
 * @method static Builder|Nature whereStructureId($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Courrier> $courriers
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Depart> $departs
 *
 * @mixin \Eloquent
 */
class Nature extends Model
{
    use HasFactory, DateFormat;

    protected $fillable = ['nom', 'structure_id'];

    /**
     * Get all of the courriers for the Nature
     */
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }

    /**
     * Get all of the departs for the Nature
     */
    public function departs(): HasMany
    {
        return $this->hasMany(Depart::class);
    }

    /**
     * Get the structure that owns the Nature
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }
}
