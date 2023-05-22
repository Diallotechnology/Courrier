<?php

namespace App\Models;

use App\Models\User;
use App\Models\Interne;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
