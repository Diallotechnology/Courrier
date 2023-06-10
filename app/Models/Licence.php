<?php

namespace App\Models;

use App\Models\Structure;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Licence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['structure_id', 'code', 'date_expiration', 'version', 'active','activated_at'];

    /**
     * Get the structure that owns the Licence
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    // fonction pour générer un code de licence unique
    function generateLicenseCode($length = 64): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_+=,.<>{}[]';
        $licenseCode = '';

        $characterCount = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $licenseCode .= $characters[rand(0, $characterCount - 1)];
        }

        return $licenseCode;
    }

    public function isTrialVersion()
    {
        if (!$this->activated_at) {
            return false; // La licence n'a pas été activée
        }

        $trialPeriod = 15; // Durée de la période d'essai en jours
        $expirationDate = $this->activated_at->addDays($trialPeriod);

        return now()->lt($expirationDate);
    }

    public function isExpired()
    {
        return $this->date_expiration < now();
    }



}
