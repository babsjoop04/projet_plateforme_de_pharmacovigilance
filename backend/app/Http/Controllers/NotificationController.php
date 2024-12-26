<?php

namespace App\Http\Controllers;

use App\Mail\MailInfoNotification;
use App\Models\Notification;
use App\Models\Aggregation_notification_produit_sante;
use App\Models\Traitement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

// use App\Http\Requests\StoreNotificationRequest;
// use App\Http\Requests\UpdateNotificationRequest;

class NotificationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // Gate::authorize("view_any_notification", $request->user());
        $user = $request->user();



        // return $request;
        $notifications = [];

        if ($user->role_utilisateur !== "responsable_organisme_reglementation") {
            # code...
            $notifications = $user->notification()->get();
        } else {
            // return 
            $traitements = Traitement::pluck('notification_id')->all();
            $notifications = Notification::whereNotIn("id", $traitements)->get();
        }

        foreach ($notifications as $notification) {

            $aggregations = $notification->aggregation()->get();
            foreach ($aggregations as $aggregation) {
                // $aggregation->infos=
                $aggregation->produit_sante;
            }

            $notification->produits = $aggregations;
        }

        return $notifications;
        // }

        // return Notification::all();

        // return [
        //     "message" => "comme se nait rien fait",
        // ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //  return  $request;
        // return $request->type_notification==="notification_eeim" && in_array($request->user()->role_utilisateur, ["professionnel_sante","PRV_exploitant","consommateur"]);

        // switch ($request->type_notification) {
        //     case "notification_eeim":
        //     case "notification_pqif":

        //         // Gate::authorize('create_eeim_pqif_notification', $request->user());
        //         break;


        //     case "notification_mapi":

        //         // Gate::authorize('create_mapi', $request->user());

        //         break;
        // }

        $user=$request->user();


        if ($request->type_notification === "notification_pqif") {

            $fields = $request->validate([
                'type_notification' => 'required|in:notification_pqif',
                //info constatateur PQIF
                'prenom_constatateur' => 'required|max:255',
                'nom_constatateur' => 'required|max:255',
                'adresse_constatateur' => 'required|max:255',
                'tel_constatateur' => 'required|max:255',
                'date_signalement_suspicion_pqif' => 'required|date',
                // 'echantillon_conserve' => 'required|boolean',
                'tel_detenteur' => 'nullable|max:255',

                //description evenement PQIF
                'date_survenue_incident' => 'required|date',
                'moment_detection_incident' => 'required|max:255',
                'mesure_prise' => 'required',
                'nature_incident' => 'required',
                'circonstances_incident' => 'required',
                'consequence_clinique' => 'required|boolean',
                // 'description_evenement_si_consequence_clinique',

                'description_evenement' => 'nullable',
                'date_apparition_evenement' => 'required|date',
                'date_disparition_evenement' => 'required|date',
                // 'produit_sante_id' => 'required'

            ]);

            $fields_aggregation = $request->validate([
                'produit_sante_id' => "required",
                "numero_lot" => 'required',
                "provenance" => 'required',
                'echantillon_conserve' => 'required|boolean',

                "date_peremption" => 'required|date',
            ]);

            $notification = $user->notification()->create($fields);
            // return $notification;
            $notification->aggregation()->create($fields_aggregation);

            return [
                "message" => "Notification faite avec success",
            ];
        }

        if (in_array($request->type_notification, ["notification_mapi", "notification_eeim"])) {

            $fields = $request->validate(
                [
                    'type_notification' => 'required|in:notification_mapi,notification_eeim',
                    //info patient MAPI_EEIM
                    'numero_dossier_patient' => 'required|max:255',
                    'prenom_initiale' => 'required|max:255',
                    'nom_initiale' => 'required|max:255',
                    'adresse_patient' => 'required|max:255',
                    'tel_patient' => 'required|max:255',
                    'date_naissance_patient' => 'required|date',
                    'sexe' => 'required|max:255',
                    'antecedentsMedicaux_facteursRisques_facteursAssocies' => 'required',
                    // 'patiente_enceinte'=> 'required|boolean',
                    // 'age_gestationnel'=> 'nullable',

                    //description evenement EEIM-MAPI
                    // 'description_evenement_EEIM_MAPI',
                    'readministration' => 'required|boolean',
                    'reapparition_apres_readministration' => 'nullable|boolean',
                    'traitement_correcteur' => 'required|boolean',
                    'text_traitement_correcteur' => 'nullable',
                    'suivi_patient' => 'required|max:255',
                    'evolution_situation_patient' => 'required|max:255',

                    // 'description_evenement_si_consequence_clinique',
                    'motif_prise_produits_sante' => 'required',
                    'description_evenement' => 'required',
                    'date_apparition_evenement' => 'required|date',
                    'date_disparition_evenement' => 'required|max:255'

                ]
            );




            $fields_aggregation = $request->validate([

                'infos_produits_santes' => "required|array",
                'infos_produits_santes.*.produit_sante_id' => "required",
                "infos_produits_santes.*.type_produit" => "required|in:medicament,vaccin,autre",
                "infos_produits_santes.*.numero_lot" => 'required',
                "infos_produits_santes.*.provenance" => 'required',
                "infos_produits_santes.*.date_peremption" => 'required|date',
                "infos_produits_santes.*.posologie" => 'exclude_if:infos_produits_santes.*.type_produit,vaccin|required',

                // medicament
                "infos_produits_santes.*.date_debut_prise" => 'exclude_unless:infos_produits_santes.*.type_produit,medicament|required|date',
                "infos_produits_santes.*.date_fin_prise" => 'exclude_unless:infos_produits_santes.*.type_produit,medicament|required|date',
                // "infos_produits_santes.*.date_fin_prise"=>'exclude_unless:infos_produits_santes.*.type_produit,medicament|nullable|date' ,


                // autre
                "infos_produits_santes.*.date_prise" => 'exclude_unless:infos_produits_santes.*.type_produit,autre|required|date',



                // vaccin
                "infos_produits_santes.*.date_ouverture_flacon" => 'exclude_unless:infos_produits_santes.*.type_produit,vaccin|required|date',
                "infos_produits_santes.*.date_vaccination" => 'exclude_unless:infos_produits_santes.*.type_produit,vaccin|required|date',
                "infos_produits_santes.*.site_administration" => 'exclude_unless:infos_produits_santes.*.type_produit,vaccin|required|max:255',
                "infos_produits_santes.*.nombre_contact_vaccin" => 'exclude_unless:infos_produits_santes.*.type_produit,vaccin|required|numeric',
                "infos_produits_santes.*.nom_solvant" => 'exclude_unless:infos_produits_santes.*.type_produit,vaccin|required|max:255',
                "infos_produits_santes.*.date_peremption_solvant" => 'exclude_unless:infos_produits_santes.*.type_produit,vaccin|required|date',
                "infos_produits_santes.*.numero_lot_solvant" => 'exclude_unless:infos_produits_santes.*.type_produit,vaccin|required|max:255',
            ]);

            // return $fields_aggregation;

            $notification = $user->notification()->create($fields);

            foreach ($request->infos_produits_santes as $produit_sante) {

                $notification->aggregation()->create($produit_sante);
            }

            Mail::to($user["email"])->send(new MailInfoNotification(["nom"=>$user["prenom"]." ".$user["nom"],"date_declaration"=>$notification["created_at"]]));


            return [
                "message" => "Notification faite avec success",
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
        // Gate::authorize("view_notification", $notification);

        $aggregations = $notification->aggregation()->get();
        foreach ($aggregations as $aggregation) {
            // $aggregation->infos=
            $aggregation->produit_sante;
        }

        $notification->produits = $aggregations;
        
        return $notification;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {

        //
        // Gate::authorize("update_notification", $notification);
        // $fields=[];
        // $request->validate(
        //     [
        //         'type_notification'=> 'required|in:notification_mapi,notification_eeim,notification_pqif'
        //         ]
        //     );


        if (in_array($request->type_notification, ["notification_mapi", "notification_eeim"])) {
            $fields = $request->validate(
                [
                    'type_notification' => 'required|in:notification_mapi,notification_eeim',
                    //info patient MAPI_EEIM
                    'numero_dossier_patient' => 'required|in:notification_mapi,notification_eeim',
                    'prenom_initiale' => 'required|max:255',
                    'nom_initiale' => 'required|max:255',
                    'adresse_patient' => 'required|max:255',
                    'tel_patient' => 'required|max:255',
                    'date_naissance_patient' => 'required|date',
                    'sexe' => 'required|max:255',
                    'antecedentsMedicaux_facteursRisques_facteursAssocies' => 'required',
                    'patiente_enceinte' => 'required|boolean',
                    'age_gestationnel' => 'nullable',

                    //description evenement EEIM-MAPI
                    //  'description_evenement_EEIM_MAPI',
                    'readministration' => 'required|boolean',
                    'reapparition_apres_readministration' => 'required|boolean',
                    'traitement_correcteur' => 'required|boolean',
                    'text_traitement_correcteur' => 'nullable',
                    'suivi_patient' => 'required|max:255',
                    'evolution_situation_patient' => 'required|max:255',

                    // 'description_evenement_si_consequence_clinique',
                    'motif_prise_produits_sante' => 'required',
                    'description_evenement' => 'required',
                    'date_apparition_evenement' => 'required|date',
                    'date_disparition_evenement' => 'required|max:255'

                ]
            );



            $notification->update($fields);

            return [
                "message" => "notification mise à jour avec success"
            ];
        } elseif ($request->type_notification === "notification_pqif") {

            $fields = $request->validate([
                'type_notification' => 'required|in:notification_pqif',
                //info constatateur PQIF
                'prenom_constatateur' => 'required|max:255',
                'nom_constatateur' => 'required|max:255',
                'adresse_constatateur' => 'required|max:255',
                'tel_constatateur' => 'required|max:255',
                'date_signalement_suspicion_pqif' => 'required|date',
                'echantillon_conserve' => 'required|boolean',
                'tel_detenteur' => 'nullable|max:255',

                //description evenement PQIF
                'date_survenue_incident' => 'required|date',
                'moment_detection_incident' => 'required|max:255',
                'mesure_prise' => 'required|',
                'nature_incident' => 'required',
                'circonstances_incident' => 'required',
                'consequence_clinique' => 'required|boolean',
                // 'description_evenement_si_consequence_clinique',

                'description_evenement' => 'nullable',
                'date_apparition_evenement' => 'required|date',
                'date_disparition_evenement' => 'required|date'

            ]);

            $notification->update($fields);
            return [
                "message" => "notification mise à jour avec success"
            ];
        }

        // $notification->update($fields);

        // return [
        //         "message"=>"notification mise à jour avec success"
        //      ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
        // Gate::authorize("delete_notification");

        $notification->delete();
        return [
            "message" => "notification supprimée avec success"
        ];
    }
}
