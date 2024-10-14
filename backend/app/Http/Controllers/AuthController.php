<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    //
    public function register(Request $request){

        if (in_array($request->role_utilisateur,["consommateur","responsable_organisme_reglementation"])) {

        //    return "hello cons";
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
           'email'=> 'required|email|unique:users' ,
           'password'=> 'required|confirmed' 
           ]);
   
           $user=User::create($fields);
   
           return $user;
        }


        if ($request->role_utilisateur==="PRV_exploitant") {

            $fields_prv=$request->validate([
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
           'email'=> 'required|email|unique:users' ,
           'password'=> 'required|confirmed' ,
           //prv_exploitant
           "activite_exploitation"=> 'required' ,
           "numero_agrement"=> 'required' ,
           "date_agrement" => 'required',
           //agence promotion
           "Nom_laboratoire_représenté_localement" => 'nullable',
           ]);

           
           $user=User::create($fields_prv);
   
           return $user;
           }
        

        if( $request->role_utilisateur=== 'professionnel_sante') {
            $fields_pro=$request->validate([
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
                
                ]);
        
                $user=User::create($fields_pro);
        
                return $user;
        }




}
    public function login(Request $request){

        $request->validate([
            'email'=> 'required|email|exists:users' ,
            'password'=> 'required' ,
            ]);

        $user=User::where('email',$request->email)->first();
        if(!$user || !Hash::check( $request->password,$user->password) ){  
            return [
                'message' => "Les identifiants de connexion ne sont pas corrects. Nous vous invitons à réessayer"
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

        if($request->decision=== "demande_inscription_refusée"){

            $user->delete();

            return [
                "message"=> "demande refusée  et supprimée avec succes"
            ];


        }

        if (in_array($request->decision,["réactivation_compte","demande__inscription_acceptée"])) {
           
            $user["statut"]="actif";
    
             $user->update([$user]) ;
    
             return $user;
        }

        if($request->decision==="desactivation_compte"){

            $user["statut"]="desactivé";
    
             $user->update([$user]) ;
    
             return $user;
        }

       


            
        


    }
}
