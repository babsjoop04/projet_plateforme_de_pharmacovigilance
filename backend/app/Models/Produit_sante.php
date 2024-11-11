<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit_sante extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'nom',
        'nom_produit',
        'type_produit',
        'numero_AMM',
        'date_début',
        'prix_public',

        'DCI',
        'dosage',
        'conditionnement',
        'forme_galénique',
        'laboratoire',
        'voie_administration',
        'classe_thérapeutique',
        // 'notice',

    ];

    public function exploitation()
    {
        return $this->hasMany(Exploitation::class);
    }
}
