<?php

namespace App\Models;

use App\Models\User;
use App\Helper\DateFormat;
use App\Models\Imputation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Annotation
 *
 * @property int $id
 * @property int $user_id
 * @property string $nom
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\AnnotationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Imputation> $imputations
 * @property-read int|null $imputations_count
 * @property-read string $date_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Imputation> $imputations
 * @method static \Illuminate\Database\Eloquent\Builder|Annotation byStructure()
 * @mixin \Eloquent
 */
class Annotation extends Model
{
    use HasFactory, DateFormat;

    protected $fillable = ['nom','user_id'];

    /**
     * Get the user that owns the Annotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The imputations that belong to the Annotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function imputations(): BelongsToMany
    {
        return $this->belongsToMany(Imputation::class);
    }
}
