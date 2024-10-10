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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            
            // $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();    
            $table->string('type_notification');
            
            //info patient MAPI_EEIM
            $table->integer('numero_dossier_patient')->nullable();
            $table->string('prenom_initiale')->nullable();
            $table->string('nom_initiale')->nullable();
            $table->string('adresse_patient')->nullable();
            $table->string('tel_patient')->nullable();
            $table->date('date_naissance_patient')->nullable();
            $table->string('sexe')->nullable();
            $table->text( 'antecedentsMedicaux_facteursRisques_facteursAssocies')->nullable();
            $table->boolean('patiente_enceinte')->nullable();
            $table->integer('age_gestationnel')->nullable();
                    
            
            //info constatateur PQIF
            $table->string('prenom_constatateur')->nullable(); 
            $table->string('nom_constatateur')->nullable(); 
            $table->string('adresse_constatateur')->nullable(); 
            $table->string('tel_constatateur')->nullable(); 
            $table->date('date_signalement_suspicion_pqif')->nullable(); 
            $table->boolean('echantillon_conserve')->nullable(); 
            $table->string('tel_detenteur')->nullable(); 

            //description evenement EEIM-MAPI
            // $table->text('description_evenement_EEIM_MAPI');
            $table->boolean('readministration')->nullable();
            $table->boolean('reapparition_apres_readministration')->nullable();
            $table->boolean('traitement_correcteur')->nullable();
            $table->text('text_traitement_correcteur')->nullable();
            $table->string('suivi_patient')->nullable();
            $table->string('evolution_situation_patient')->nullable();

            //description evenement PQIF
            $table->date('date_survenue_incident')->nullable(); 
            $table->string('moment_detection_incident')->nullable(); 
            $table->text('mesure_prise')->nullable(); 
            $table->text('nature_incident')->nullable(); 
            $table->text('circonstances_incident')->nullable(); 
            $table->boolean('consequence_clinique')->nullable(); 
            // $table->text('description_evenement_si_consequence_clinique')->nullable(); 
            
            //données communes
            $table->text('description_evenement')->nullable(); 
            $table->date('date_apparition_evenement'); 
            $table->date('date_disparition_evenement'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
