<?php

namespace App\Models;

use App\Models\User;
use App\Models\Interne;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Reponse
 *
 * @property int $id
 * @property int $interne_id
 * @property int $user_id
 * @property string $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Interne $interne
 * @property-read User $user
 * @method static \Database\Factories\ReponseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereInterneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reponse whereUserId($value)
 * @mixin \Eloquent
 */
class Reponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['interne_id','message','user_id'];

    protected function getCreatedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->locale('fr')->diffForHumans();
    }

    /**
     * Get the interne that owns the Reponse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interne(): BelongsTo
    {
        return $this->belongsTo(Interne::class);
    }

    /**
     * Get the user that owns the Reponse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
