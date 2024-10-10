<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

// use App\Http\Requests\StoreNotificationRequest;
// use App\Http\Requests\UpdateNotificationRequest;

class NotificationController extends Controller 
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Notification::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (!in_array($request->type_notification,["notification_MAPI","notification_EEIM","notification_PQIF"])) {
            # code...
            return [
                'message'=>"error notification type"
            ];
        }
       

        if (in_array($request->type_notification,["notification_MAPI","notification_EEIM"])) {
            $fields=$request->validate(
                [
                    'type_notification'=> 'required|max:255' ,
                   //info patient MAPI_EEIM
                    'numero_dossier_patient'=> 'required|max:255',
                    'prenom_initiale'=> 'required|max:255',
                    'nom_initiale'=> 'required|max:255',
                    'adresse_patient'=> 'required|max:255',
                    'tel_patient'=> 'required|max:255',
                    'date_naissance_patient'=> 'required|date',
                    'sexe'=> 'required|max:255',
                    'antecedentsMedicaux_facteursRisques_facteursAssocies'=> 'required',
                    'patiente_enceinte'=> 'required|boolean',
                    'age_gestationnel'=> 'nullable',
           
                   //description evenement EEIM-MAPI
                   //  'description_evenement_EEIM_MAPI',
                    'readministration'=> 'required|boolean',
                    'reapparition_apres_readministration'=> 'required|boolean',
                    'traitement_correcteur'=> 'required|boolean',
                    'text_traitement_correcteur'=> 'nullable',
                    'suivi_patient'=> 'required|max:255',
                    'evolution_situation_patient'=> 'required|max:255',
           
                   // 'description_evenement_si_consequence_clinique',
                    
                   'description_evenement'=> 'required',
                   'date_apparition_evenement'=> 'required|date',
                   'date_disparition_evenement'=> 'required|max:255'
           
                ]
            );
            
            // return 'hello MAPI_EEIM';

            $notification=$request->user()->notification()->create($fields);
            return $notification;
        

        }
        elseif ($request->type_notification==="notification_PQIF") {

            $fields=$request->validate([
                'type_notification' => 'required|max:255',
                //info constatateur PQIF
                'prenom_constatateur'=> 'required|max:255',
                'nom_constatateur'=> 'required|max:255',
                'adresse_constatateur'=> 'required|max:255',
                'tel_constatateur'=> 'required|max:255',
                'date_signalement_suspicion_pqif'=> 'required|date',
                'echantillon_conserve'=> 'required|boolean',
                'tel_detenteur'=> 'nullable|max:255',
       
               //description evenement PQIF
               'date_survenue_incident'=> 'required|date',
               'moment_detection_incident'=> 'required|max:255',
               'mesure_prise'=> 'required|',
               'nature_incident'=> 'required',
               'circonstances_incident'=> 'required',
               'consequence_clinique'=> 'required|boolean',
               // 'description_evenement_si_consequence_clinique',
                
               'description_evenement'=> 'nullable',
               'date_apparition_evenement'=> 'required|date',
               'date_disparition_evenement'=> 'required|date'
       
            ]);

            // $notification=$request->user() Notification::create($fields);
            // return $notification;
            // return $request->user();

        }

        

    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
        return $notification;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {

        //

        
        if (in_array($request->type_notification,["notification_MAPI","notification_EEIM"])) {
            $fields=$request->validate(
                [
                    'type_notification'=> 'required|max:255' ,
                   //info patient MAPI_EEIM
                    'numero_dossier_patient'=> 'required|max:255',
                    'prenom_initiale'=> 'required|max:255',
                    'nom_initiale'=> 'required|max:255',
                    'adresse_patient'=> 'required|max:255',
                    'tel_patient'=> 'required|max:255',
                    'date_naissance_patient'=> 'required|date',
                    'sexe'=> 'required|max:255',
                    'antecedentsMedicaux_facteursRisques_facteursAssocies'=> 'required',
                    'patiente_enceinte'=> 'required|boolean',
                    'age_gestationnel'=> 'nullable',
           
                   //description evenement EEIM-MAPI
                   //  'description_evenement_EEIM_MAPI',
                    'readministration'=> 'required|boolean',
                    'reapparition_apres_readministration'=> 'required|boolean',
                    'traitement_correcteur'=> 'required|boolean',
                    'text_traitement_correcteur'=> 'nullable',
                    'suivi_patient'=> 'required|max:255',
                    'evolution_situation_patient'=> 'required|max:255',
           
                   // 'description_evenement_si_consequence_clinique',
                    
                   'description_evenement'=> 'required',
                   'date_apparition_evenement'=> 'required|date',
                   'date_disparition_evenement'=> 'required|max:255'
           
                ]
            );
            
            

            $notification->update($fields);

            return $notification;

        }
        elseif ($request->type_notification==="notification_PQIF") {

            $fields=$request->validate([
                'type_notification' => 'required|max:255',
                //info constatateur PQIF
                'prenom_constatateur'=> 'required|max:255',
                'nom_constatateur'=> 'required|max:255',
                'adresse_constatateur'=> 'required|max:255',
                'tel_constatateur'=> 'required|max:255',
                'date_signalement_suspicion_pqif'=> 'required|date',
                'echantillon_conserve'=> 'required|boolean',
                'tel_detenteur'=> 'nullable|max:255',
       
               //description evenement PQIF
               'date_survenue_incident'=> 'required|date',
               'moment_detection_incident'=> 'required|max:255',
               'mesure_prise'=> 'required|',
               'nature_incident'=> 'required',
               'circonstances_incident'=> 'required',
               'consequence_clinique'=> 'required|boolean',
               // 'description_evenement_si_consequence_clinique',
                
               'description_evenement'=> 'nullable',
               'date_apparition_evenement'=> 'required|date',
               'date_disparition_evenement'=> 'required|date'
       
            ]);

            $notification->update($fields);
            return $notification;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
        $notification->delete();
        return [
            "message"=>"notification supprimée avec success"
        ];
    }
}
