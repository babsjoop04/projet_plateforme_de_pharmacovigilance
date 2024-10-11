<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
         'type_notification' ,
        //info patient MAPI_EEIM
         'numero_dossier_patient',
         'prenom_initiale',
         'nom_initiale',
         'adresse_patient',
         'tel_patient',
         'date_naissance_patient',
         'sexe',
         'antecedentsMedicaux_facteursRisques_facteursAssocies',
         'patiente_enceinte',
         'age_gestationnel',

         //info constatateur PQIF
         'prenom_constatateur',
         'nom_constatateur',
         'adresse_constatateur',
         'tel_constatateur',
         'date_signalement',
         'echantillon_conserve',
         'tel_detenteur',

        //description evenement EEIM-MAPI
        //  'description_evenement_EEIM_MAPI',
         'readministration',
         'reapparition_apres_readministration',
         'traitement_correcteur',
         'text_traitement_correcteur',
         'suivi_patient',
         'evolution_situation_patient',

        //description evenement PQIF
        'date_survenue_incident',
        'moment_detection_incident',
        'mesure_prise',
        'nature_incident',
        'circonstances_incident',
        'consequence_clinique',
        // 'description_evenement_si_consequence_clinique',
        'motif_prise_produits_sante',
        'description_evenement',
        'date_apparition_evenement',
        'date_disparition_evenement'

     ];

     public function user(){
        return $this->belongsTo(User::class);
     }

     public function aggregation(){
      return $this->hasMany(Aggregation_notification_produit_sante::class);
   }

}
