<?php

namespace App\Models;

use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\History
 *
 * @property int $id
 * @property int $courrier_id
 * @property int $user_id
 * @property string $action
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Courrier $courrier
 *
 * @method static \Database\Factories\HistoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History query()
 * @method static \Illuminate\Database\Eloquent\Builder|History whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereCourrierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUserId($value)
 *
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|History onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|History whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|History withoutTrashed()
 *
 * @property-read string $date_format
 *
 * @method static \Illuminate\Database\Eloquent\Builder|History byStructure()
 *
 * @mixin \Eloquent
 */
class History extends Model
{
    use DateFormat, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'courrier_id', 'action', 'description'];

    /**
     * Get the courrier that owns the History
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }

    /**
     * Get the user that owns the History
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
