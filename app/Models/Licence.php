<?php

namespace App\Models;

use App\Enum\LicenceEnum;
use App\Helper\LicenceCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Licence extends Model
{
    use HasFactory, LicenceCode;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['structure_id', 'debut', 'fin', 'temps', 'active'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'version' => LicenceEnum::class,
        'active' => 'boolean',
    ];

    /**
     * Get the structure that owns the Licence
     */
    public function structure(): BelongsTo
    {
        return $this->belongsTo(Structure::class);
    }

    //vérification de l'authenticité du code de licence
    public function verifyLicenseCode($licenseCode)
    {
        $license = self::where('code', $licenseCode)->firstOrFail();

        if ($license) {
            // Le code de licence est valide
        } else {
            // Le code de licence est invalide
        }
    }

    //renouvellement de licence
    public function renewLicense(int $structure, int $temps)
    {
        return DB::transaction(function () use ($structure, $temps) {
            $license = self::where('structure_id', $structure)->lockForUpdate()->firstOrFail();
            // Mettre à jour la date d'expiration de la licence
            $license->update([
                'code' => $this->generateLicenseCode(),
                'version' => LicenceEnum::LICENCE,
                'active' => 1,
                'debut' => now(),
                'fin' => now()->addMonth($temps),
            ]);
        });
    }

    public function isTrialVersion()
    {
        return $this->version === 'trial' && $this->code == null;
    }

    public function isExpired()
    {
        return $this->fin < now();
    }
}
