<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit_sante extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        // 'nom_produit',
        // 'type_produit',
        // 'numero_AMM',
        // 'DCI',
        // 'dosage',
        // 'conditionnement',
        // 'forme_galénique',
        // 'laboratoire',
        // 'voie_administration',
        // 'classe_thérapeutique',
    ];

    public function exploitation()
    {
        return $this->hasMany(Exploitation::class);
    }
}
