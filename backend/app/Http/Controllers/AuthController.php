<?php

namespace App\Http\Controllers;

use App\Mail\MailAcceptationDemandeInscription;
use App\Mail\MailBienvenue;
use App\Mail\MailDemandeInscription;
use App\Mail\MailDesactivationCompte;
use App\Mail\MailReactivationCompte;
use App\Mail\MailRefusDemandeInscription;
use App\Mail\MessageHello;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        $fields = [];

        $request->validate([
            "role_utilisateur" => 'required|in:consommateur,administrateur,professionnel_sante,responsable_organisme_reglementation,PRV_exploitant'
        ]);

        switch ($request->role_utilisateur) {
            case "administrateur":

            case "consommateur":

                $fields = $request->validate([
                    'nom' => 'required|max:255',
                    'prenom' => 'required|max:255',
                    'sexe' => 'required|max:255',
                    'adresse' => 'required|max:255',
                    'telephone' => 'required|max:255',
                    'dateNaissance' => 'required|date',
                    'profession' => 'required|max:255',
                    'role_utilisateur' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed'
                ]);

                $fields["statut"] = "activé";

                $user = User::create($fields);

                Mail::to($user["email"])->send(new MailBienvenue(["nom" => $user["prenom"] . " " . $user["nom"]]));





                return [
                    "message" => "Compte créé avec success",
                ];

                // $user=User::create($fields);

                // return $user;

                // break;

            case "responsable_organisme_reglementation":

                $fields = $request->validate([
                    'nom' => 'required|max:255',
                    'prenom' => 'required|max:255',
                    'sexe' => 'required|max:255',
                    'adresse' => 'required|max:255',
                    'telephone' => 'required|max:255',
                    'dateNaissance' => 'required|date',
                    'profession' => 'required|max:255',
                    'structure_travail' => 'required|max:255',
                    'adresse_structure_travail' => 'required|max:255',
                    'role_utilisateur' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed',
                    // 'files' => 'required|file|mimes:zip',
                ]);





                $fields["statut"] = "attente_traitement";


                break;

            case "PRV_exploitant":

                $fields = $request->validate([
                    'nom' => 'required|max:255',
                    'prenom' => 'required|max:255',
                    'sexe' => 'required|max:255',
                    'adresse' => 'required|max:255',
                    'telephone' => 'required|max:255',
                    'dateNaissance' => 'required|date',
                    'profession' => 'required|max:255',
                    //    'structure_travail'=> 'nullable|max:255',
                    //    'adresse_structure_travail'=> 'nullable|max:255',
                    'role_utilisateur' => 'required',
                    'specilité' => 'nullable|max:255',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed',
                    // 'files' => 'required|file|mimes:zip',

                ]);

                $fields["statut"] = "attente_traitement";




                break;

            case "professionnel_sante":

                $fields = $request->validate([
                    'nom' => 'required|max:255',
                    'prenom' => 'required|max:255',
                    'sexe' => 'required|max:255',
                    'adresse' => 'required|max:255',
                    'telephone' => 'required|max:255',
                    'dateNaissance' => 'required|date',
                    'profession' => 'required|max:255',
                    'structure_travail' => 'nullable|max:255',
                    'adresse_structure_travail' => 'nullable|max:255',
                    'role_utilisateur' => 'required',
                    'specilité' => 'nullable|max:255',
                    'Est_point_focal' => 'nullable|boolean', //à supprimer
                    'district_localite' => 'nullable|max:255',
                    // region à revoir
                    'email' => 'required|email|unique:users',
                    'password' => 'required|confirmed',
                    // 'files' => 'required|file|mimes:zip',

                ]);
                // return [
                //     "message" => $fields,
                // ];

                $fields["statut"] = "attente_traitement";



                break;
        }


        $user = User::create($fields);
     

        $file = $request->file('files');
        if ($file) {


            $fileName =  "demande_inscription" . '_' . $fields["email"]  . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $fileName, "public");
            $user->fichiersdemande()->create(["nom_fichiers" => $fileName]);
        }

        Mail::to($user["email"])->send(new MailDemandeInscription(["nom" => $user["prenom"] . " " . $user["nom"]]));


        return [
            "message" => "Demande d'inscription faite avec success",
        ];
    }
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            // |exists:users
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'errors' => [
                    "email" => "Aucun compte enregistré avec cet email."
                ]
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return  response()->json([
                'errors' => [
                    "password" => "Les identifiants de connexion ne sont pas corrects. Nous vous invitons à réessayer"
                ]
            ], 404);
        }

        // if ($user->statut === "attente_activation") {
        //     return [
        //         'errors' => [
        //             'message' => "Votre demande d'inscription est en attente de traitement. Nous vous invitons à contacter l'administrateur."
        //         ]
        //     ];
        // }

        // if ($user->statut === "desactivé") {
        //     return [
        //         'errors' => [

        //             'message' => "Votre compte a été desactivé. Nous vous invitons à contacter à l'adminisrtrateur pour plus d'information"
        //         ]
        //     ];
        // }



        $token = $user->createToken($user->email)->plainTextToken;

        // Mail::to("executable20@gmail.com")->send(new MessageHello(["name" => "babs"]));


        return [
            // "user" => $user,
            "token" => $token,
            "role_utilisateur" => $user->role_utilisateur,
            "prenom" => $user->prenom,
            "nom" => $user->nom,


        ];
    }
    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();
        return "Vous etes deconnecté";
    }

    public function gerer_utilisateur(Request $request)
    {

        // $request->validate([
        //     "decision"=> "require|in:demande_acceptée,demande_refusée",
        //     "email_utilisateur"=>"require|email"
        // ]);

        // Gate::authorize("gestion_utilisateur", $request->user());


        $user = User::where("email", $request->email_utilisateur)->first();



        if (!$user) {
            return [
                "error" => [
                    "email" => "Email invalide"
                ]
            ];
        }

        if ($request->decision === "demande_inscription_refusée") {

            $user["statut"] = "demande_refusée";

            $user->update([$user]);


            Mail::to($user["email"])->send(new MailRefusDemandeInscription(["nom" => $user["prenom"] . " " . $user["nom"]]));


            return [
                "message" => "Demande refusée avec succes"
            ];
        } elseif ($request->decision === "reactivation_compte") {

            $user["statut"] = "activé";

            $user->update([$user]);

            Mail::to($user["email"])->send(new MailReactivationCompte(["nom" => $user["prenom"] . " " . $user["nom"]]));


            return [
                "message" => "Compte réactivé avec succes"
            ];

            //  return $user;
        } elseif ($request->decision === "demande_inscription_acceptée") {

            $user["statut"] = "activé";

            $user->update([$user]);

            Mail::to($user["email"])->send(new MailAcceptationDemandeInscription(["nom" => $user["prenom"] . " " . $user["nom"]]));


            return [
                "message" => "Compte activé avec succes"
            ];

            //  return $user;
        } elseif ($request->decision === "desactivation_compte") {

            $user["statut"] = "desactivé";

            $user->update([$user]);

            Mail::to($user["email"])->send(new MailDesactivationCompte(["nom" => $user["prenom"] . " " . $user["nom"]]));


            return [
                "message" => "Compte desactivé avec succes"
            ];

            //  return $user;
        }
    }

    public function getDemande(Request $request)
    {

        // $request->validate([
        //     "decision"=> "require|in:demande_acceptée,demande_refusée",
        //     "email_utilisateur"=>"require|email"
        // ]);

        // Gate::authorize("gestion_utilisateur", $request->user());N


        $users = User::where("statut", "attente_traitement")->get();
        // 
        return $users->groupBy('role_utilisateur');
    }

    public function index(Request $request)
    {

        // $request->validate([
        //     "decision"=> "require|in:demande_acceptée,demande_refusée",
        //     "email_utilisateur"=>"require|email"
        // ]);

        // Gate::authorize("gestion_utilisateur", $request->user());N



        $users = User::whereNot("statut", "attente_traitement")->get();

        return $users->groupBy('role_utilisateur');
    }
}
