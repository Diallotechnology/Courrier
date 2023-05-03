<?php

namespace App\Models;

use App\Helper\DateFormat;
use App\Models\Departement;
use App\Models\Correspondant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory, DateFormat;

    /**
     * Get all of the correspondants for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function correspondants(): HasMany
    {
        return $this->hasMany(Correspondant::class);
    }

    /**
     * Get all of the departements for the Structure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departements(): HasMany
    {
        return $this->hasMany(Departement::class);
    }
}
