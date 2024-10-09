<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $fields=$request->validate([
        'nom' => 'required|max:255' ,
        'prenom'=> 'required|max:255',
        'sexe' => 'required|max:255',
        'adresse' => 'required|max:255',
        'telephone' => 'required|max:255',
        'dateNaissance' => 'required|date',
        'profession' => 'required|max:255',
        'structure_travail'=> 'nullable|max:255',
        'role' => 'required|max:255',
        'specilité' => 'nullable|max:255' ,  
        'Est_point_focal' => 'required|boolean',
        'district_localite'=> 'nullable|max:255',
        'email'=> 'required|email|unique:users' ,
        'password'=> 'required|confirmed' ,
        ]);

        $user=User::create($fields);

        return $user;


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

        // if ($user->statut === "disabled" ) {
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
}
