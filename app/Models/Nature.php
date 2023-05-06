<?php

namespace App\Models;

use App\Models\Courrier;
use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
 * @mixin \Eloquent
 */
class Nature extends Model
{
    use HasFactory, DateFormat;

    protected $fillable = ['nom'];

    /**
     * Get all of the courriers for the Nature
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courriers(): HasMany
    {
        return $this->hasMany(Courrier::class);
    }
}
