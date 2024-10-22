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
        Schema::create('decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traitement_id')->unique()->constrained();
            $table->enum('decision',["suspension_AMM","retrait_AMM","rappel_lot","mise_en_quarantaine","restriction_utlisation_prescription","demande_modification_informations","changement_liste","reevaluation_rapport_benefice_risque"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decisions');
    }
};
