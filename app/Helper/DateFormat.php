<?php

namespace App\Helper;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

    // protected function getDeletedAtAttribute(string $date): string
    // {
    //     return Carbon::parse($date)->format('d/m/Y H:i:s');
    // }

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


    public function generateId(string $prefix_type)
    {
        $prefix = $prefix_type . Carbon::today()->format('Y') . '-';

        return DB::transaction(function () use ($prefix) {
            // Verrouille le dernier identifiant de courrier enregistré dans la base de données pour la mise à jour
            // $lastCourrier = self::where('reference', 'like', $prefix .'%')
            $lastCourrier = self::where('reference', 'like', $prefix .'%')->whereNotNull('reference')
            ->latest('id')
            ->lockForUpdate()
            ->first(['reference']);
            // Si aucun identifiant de courrier n'a été enregistré, définit le numéro de séquence à 0
            $sequence = 0;
            if ($lastCourrier) {
                // Récupère le numéro de séquence de l'identifiant de courrier précédent
                $sequence = (int)substr($lastCourrier->reference, strlen($prefix));
            }

            // Incrémente le numéro de séquence et génère le nouvel identifiant de courrier
            $sequence++;
            $newCourrierNumber = $prefix . $sequence;
            // \dd($newCourrierNumber);
            // Met à jour le numéro de courrier de l'instance courante
            $this->reference = $newCourrierNumber;
            $this->save();
            return $this;
        });
    }

    public function generateNum()
    {
        return DB::transaction(function () {
            $lastCourrier = self::latest()->lockForUpdate()->first();
            \dd($lastCourrier);
            // Si aucun identifiant de courrier n'a été enregistré, définit le numéro de séquence à 0
            $sequence = 0;
            if ($lastCourrier) {
                // Récupère le numéro de séquence de l'identifiant de courrier précédent
                $lastCourrier->increment('numero');
                $newCourrierNumber = $lastCourrier->numero;
            //    dd($lastCourrier->numero);
            }
            // Incrémente le numéro de séquence et génère le nouvel identifiant de courrier
            // $sequence+1;
            // $newCourrierNumber = $sequence;

            // Met à jour le numéro de courrier de l'instance courante
            $this->numero = $newCourrierNumber;
            $this->save();
            return $this;
        });
    }

}
