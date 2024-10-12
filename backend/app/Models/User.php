<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HasApiTokens;
    // ,HasUuids

   

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom' ,
        'prenom',
        'sexe' ,
        'adresse' ,
        'telephone' ,
        'dateNaissance' ,
        'profession' ,
        'structure_travail',
        'adresse_structure_travail',
        'role_utilisateur' ,
        'specilité'  ,  
        'Est_point_focal' ,
        'district_localite',
        'email' ,
        'password' ,
        'password_confirmation' ,
    //prv_exploitant
       
        "activite_exploitation" ,
        "numero_agrement" ,
        "date_agrement" ,
        //agence promotion
        "Nom_laboratoire_représenté_localement" ,
   
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function notification(){
        return $this->hasMany(Notification::class);
     }

     public function exploitation(){
        return $this->hasMany(Exploitation::class);
     }
}
