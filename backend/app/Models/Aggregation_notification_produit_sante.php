<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aggregation_notification_produit_sante extends Model
{
    use HasFactory;
    protected $fillable = [
        // "id_notification", 
        // "id_produit_sante", 
        //eeim
        "posologie",
        "date_debut_prise", 
        "date_fin_prise",       

        //mapi
        "date_ouverture_flacon" ,
         "date_vaccination" ,
        "site_administration" ,
        "nombre_contact_vaccin" ,
        "nom_solvant", 
        "date_peremption_solvant",
        "numero_lot_solvant",

        "numero_lot", 
        "provenance" ,
        "date_peremption", 
        "produit_sante_id"
        
    ] ;


    public function notification(){
        return $this->belongsTo(Notification::class);
     }

     public function produit_sante(){
        return $this->hasMany(Produit_sante::class);
     }
 
}
