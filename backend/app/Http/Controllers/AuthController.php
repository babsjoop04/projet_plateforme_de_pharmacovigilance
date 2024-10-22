<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function register(Request $request){

        $fields=[];

        $request->validate([
            "role_utilisateur"=>'required|in:consommateur,administrateur,professionnel_sante,responsable_organisme_reglementation,PRV_exploitant'
        ]);

        switch ($request->role_utilisateur) {
            case "administrateur":
            
            case "consommateur":

                $fields=$request->validate([
                    'nom' => 'required|max:255' ,
                    'prenom'=> 'required|max:255',
                    'sexe' => 'required|max:255',
                    'adresse' => 'required|max:255',
                    'telephone' => 'required|max:255',
                    'dateNaissance' => 'required|date',
                    'profession' => 'required|max:255',
                 //    'structure_travail'=> 'nullable|max:255',
                 //    'adresse_structure_travail'=> 'nullable|max:255',
                    'role_utilisateur' => 'required',
                    'email'=> 'required|email|unique:users' ,
                    'password'=> 'required|confirmed' 
                    ]);
         
                $fields["statut"]="activé";
            
                break;
    
            case "responsable_organisme_reglementation":

                $fields=$request->validate([
                    'nom' => 'required|max:255' ,
                    'prenom'=> 'required|max:255',
                    'sexe' => 'required|max:255',
                    'adresse' => 'required|max:255',
                    'telephone' => 'required|max:255',
                    'dateNaissance' => 'required|date',
                    'profession' => 'required|max:255',
                    'structure_travail'=> 'required|max:255',
                    'adresse_structure_travail'=> 'required|max:255',
                    'role_utilisateur' => 'required',
                    'email'=> 'required|email|unique:users' ,
                    'password'=> 'required|confirmed',
                    // 'files' => 'required|file|mimes:zip', 
                    ]);


                    // $file = $request->file('files');
                    // $lien_fichiers = time() . '_' . $file->getClientOriginalName();
                    // $file->storeAs('uploads', $lien_fichiers);
         
                $fields["statut"]="attente_traitement";

                // $fields["lien_fichiers"]=$lien_fichiers;

    
    
                break;
    
            case "PRV_exploitant":

                $fields=$request->validate([
                    'nom' => 'required|max:255' ,
                    'prenom'=> 'required|max:255',
                    'sexe' => 'required|max:255',
                    'adresse' => 'required|max:255',
                    'telephone' => 'required|max:255',
                    'dateNaissance' => 'required|date',
                    'profession' => 'required|max:255',
                 //    'structure_travail'=> 'nullable|max:255',
                 //    'adresse_structure_travail'=> 'nullable|max:255',
                    'role_utilisateur' => 'required',
                    'specilité' => 'nullable|max:255' ,  
                    'email'=> 'required|email|unique:users' ,
                    'password'=> 'required|confirmed' ,
                     // 'files' => 'required|file|mimes:zip',
                    //prv_exploitant
                 //    "activite_exploitation"=> 'required' ,
                 //    "numero_agrement"=> 'required' ,
                 //    "date_agrement" => 'required',
                    //agence promotion
                 //    "Nom_laboratoire_représenté_localement" => 'nullable',
                    ]);
         
                $fields["statut"]="attente_traitement";

                // $fields["statut"]="attente_traitement";

    
                
    
                break;

            case "professionnel_sante":

                $fields=$request->validate([
                    'nom' => 'required|max:255' ,
                    'prenom'=> 'required|max:255',
                    'sexe' => 'required|max:255',
                    'adresse' => 'required|max:255',
                    'telephone' => 'required|max:255',
                    'dateNaissance' => 'required|date',
                    'profession' => 'required|max:255',
                    'structure_travail'=> 'nullable|max:255',
                    'adresse_structure_travail'=> 'nullable|max:255',
                    'role_utilisateur' => 'required',
                    'specilité' => 'nullable|max:255' ,  
                    'Est_point_focal' => 'required|boolean',
                    'district_localite'=> 'nullable|max:255',
                    'email'=> 'required|email|unique:users' ,
                    'password'=> 'required|confirmed' ,
                     // 'files' => 'required|file|mimes:zip',
                    
                    ]);
    
                $fields["statut"]="attente_traitement";
    
                break;
        }


        $user=User::create($fields);
        
        return $user;


}
    public function login(Request $request){

        $request->validate([
            'email'=> 'required|email|exists:users' ,
            'password'=> 'required' ,
            ]);

        $user=User::where('email',$request->email)->first();
        if(!$user){  
            return [
                'error' =>[
                    "email" =>"Aucun compte n'est enregistré avec cet email."
                ] 
            ];
            
        }

        if(!Hash::check( $request->password,$user->password) ){  
            return [
                'error' =>[
                    "password" =>"Les identifiants de connexion ne sont pas corrects. Nous vous invitons à réessayer"
                ] 
            ];
            
        }
        
        // if ($user->statut === "attente_activation" ) {
        //     return [
        //         'message' => "Votre demande d'inscription est en attente de traitement. Nous vous invitons à contacter l'administrateur."
        //     ];
        // }

        // if ($user->statut === "desactivé" ) {
        //     return [
        //         'message' => "Votre compte a été desactivé. Nous vous invitons à contacter à l'adminisrtrateur pour plus d'information"
        //     ];
        // }

       

        $token= $user->createToken($user->email)->plainTextToken;

        return [
            "user" => $user,
            "token"=> $token
        ];

    }
    public function logout(Request $request){
        
        $request->user()->tokens()->delete();
        return "Vous etes deconnecté";
    }

    public function gerer_utilisateur(Request $request){

        // $request->validate([
        //     "decision"=> "require|in:demande_acceptée,demande_refusée",
        //     "email_utilisateur"=>"require|email"
        // ]);

        Gate::authorize("gestion_utilisateur", $request->user());


        $user=User::where("email",$request->email_utilisateur)->first();

        if(!$user){
            return [ 
                "error"=> [
                    "email"=> "Email invalide"
                    ]
                ];
        }

        if($request->decision=== "demande_inscription_refusée"){

            $user["statut"]="demande_refusée";
    
            $user->update([$user]) ;

            return [
                "message"=> "Demande refusée avec succes"
            ];


        }

        if (in_array($request->decision,["reactivation_compte","demande_inscription_acceptée"])) {
           
            $user["statut"]="activé";
    
             $user->update([$user]) ;

            return [
                "message"=> "Compte activé avec succes"
            ];
    
            //  return $user;
        }

        if($request->decision==="desactivation_compte"){

            $user["statut"]="desactivé";
    
             $user->update([$user]) ;

             return [
                "message"=> "Compte desactivé avec succes"
            ];
    
            //  return $user;
        }

       


            
        


    }
}
