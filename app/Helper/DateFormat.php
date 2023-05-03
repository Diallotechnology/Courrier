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

    protected function getDeletedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format('d/m/Y H:m:s');
    }

    public function generateCourrierId()
    {

        $prefix = 'CO'.Carbon::today()->format('Y').'-';

        return DB::transaction(function () use ($prefix) {
            // Verrouille le dernier identifiant de facture enregistré dans la base de données pour la mise à jour
            $lastInvoice = self::where('numero', 'like', $prefix.'%')
                ->orderBy('numero', 'desc')
                ->lockForUpdate()
                ->first();

            // Si aucun identifiant de facture n'a été enregistré, définit le numéro de séquence à 0
            $sequence = 0;
            if ($lastInvoice) {
                // Récupère le numéro de séquence de l'identifiant de facture précédent
                $sequence = (int) substr($lastInvoice->numero, strlen($prefix));
            }

            // Incrémente le numéro de séquence et génère le nouvel identifiant de facture
            $sequence++;
            $this->numero = $prefix.$sequence;

            return $this;
        });
    }

}
