<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->enum('role_utilisateur',["consommateur","administrateur","professionnel_sante","responsable_organisme_reglementation","PRV_exploitant"]);
//champs communs 
            $table->string('nom');
            $table->string('prenom');
            $table->string('sexe');
            $table->string('adresse');
            $table->string('telephone');
            $table->date('dateNaissance');
            $table->string('profession');
            $table->string('structure_travail')->nullable();
            $table->string('adresse_structure_travail')->nullable();

            //pro dela sante 
            $table->string('specilité')->nullable();
            $table->boolean('Est_point_focal')->nullable();
            $table->string('district_localite')->nullable();

            $table->string('email')->unique();
            $table->string('password');
            $table->enum('statut',["attente_traitement","demande_refusée","activé","desactivé"]);
            // ->default("attente_activation")
            //prv_expoitant 
            //ETABLISSEMENT PHARMACEUTIQUE DE FABRICATION ET DE DISTRIBUTION EN GROS
            //! $table->string('lien_fichiers')->nullable();
            // $table->string('numero_agrement')->nullable();
            // $table->date('date_agrement')->nullable();
            //agence de promotion,
            // $table->string('Nom_laboratoire_représenté_localement')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
