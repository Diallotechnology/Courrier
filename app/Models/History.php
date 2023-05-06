<?php

namespace App\Models;

use App\Models\Courrier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
 * @mixin \Eloquent
 */
class History extends Model
{
    use HasFactory;

    /**
     * Get the courrier that owns the History
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function courrier(): BelongsTo
    {
        return $this->belongsTo(Courrier::class);
    }
}
