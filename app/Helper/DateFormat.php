<?php

namespace App\Helper;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

trait DateFormat
{
    use SoftDeletes;

    protected function getCreatedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format('d/m/Y');
    }

    protected function getDeletedAtAttribute(string|null $date):string|null
    {
        if ($date === null) {
            return null;
        }
        return Carbon::parse($date)->format('d/m/Y H:i:s');;
    }

    public function getDateFormatAttribute(): string
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }

    public function Normal(): bool
    {
        return $this->priorite === "Normal";
    }

    public function Urgent(): bool
    {
        return $this->priorite === "Urgent";
    }

    public function Privacy(): bool
    {
        return $this->confidentiel === "OUI" ? true : false;
    }

        /**
     * Scope to get nature by structure.
     */
    public function scopeByStructure(Builder $query): Builder
    {
        return $query->where('structure_id', Auth::user()->structure());
    }


    public function generateId(string $prefix_type)
    {
        $currentYear = Carbon::today()->format('Y');
        $prefix = $prefix_type . $currentYear . '-';

        return DB::transaction(function () use ($prefix) {
            // Verrouille le dernier identifiant de courrier enregistré dans la base de données pour la mise à jour
            $lastCourrier = self::where('numero', 'like', $prefix .'%')->whereNotNull('numero')
            ->latest('id')
            ->lockForUpdate()
            ->first(['numero']);
            // Si aucun identifiant de courrier n'a été enregistré, définit le numéro de séquence à 0
            $sequence = 0;
            if ($lastCourrier) {
                // Récupère le numéro de séquence de l'identifiant de courrier précédent
                $sequence = (int)substr($lastCourrier->numero, strlen($prefix));

            }

            // Incrémente le numéro de séquence et génère le nouvel identifiant de courrier
            $sequence++;
            $newCourrierNumber = $prefix . $sequence;
            // Met à jour le numéro de courrier de l'instance courante
            $this->numero = $newCourrierNumber;
            $this->save();
            return $this;
        });
    }

}
