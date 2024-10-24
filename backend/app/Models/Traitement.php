<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "notification_id",
        "necessite_imputabilite",
        // "resultat_imputabilite",
        "statut_traitement",
        // "decision"
    ] ;

    public function user(){
        return $this->belongsTo(User::class);
     }
     public function notification(){
        return $this->hasOne(User::class);
     }

     public function imputabilite(){
        return $this->hasOne(Imputabilite::class);
     }
     public function decision(){
        return $this->hasOne(Decision::class);
     }
}
