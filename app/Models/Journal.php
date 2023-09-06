<?php

namespace App\Models;

use App\Helper\DateFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Journal
 *
 * @property int $id
 * @property int $user_id
 * @property string $libelle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $user
 *
 * @method static \Database\Factories\JournalFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereLibelle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal withoutTrashed()
 *
 * @property-read string $date_format
 * @property-read Structure $structure
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Journal byStructure()
 *
 * @property int $structure_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereStructureId($value)
 *
 * @mixin \Eloquent
 */
class Journal extends Model
{
    use DateFormat, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'libelle', 'structure_id'];

    protected function getCreatedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format('d/m/Y H:i:s');
    }

    /**
     * Get the user that owns the Journal
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the structure that owns the Journal
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }
}
