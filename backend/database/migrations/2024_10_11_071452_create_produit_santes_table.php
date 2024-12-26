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
        Schema::create('produit_santes', function (Blueprint $table) {
            $table->id();
            // $table->string('nom');
            $table->string('nom_produit');
            $table->string('type_produit');
            
            $table->string('numero_AMM');
            $table->date('date_début');
            $table->string('prix_public');


            // ,
            $table->string('DCI');
            $table->string('dosage');
            $table->string('conditionnement');
            $table->string('forme_galénique');
            $table->string('laboratoire');
            $table->string('voie_administration');
            $table->string('classe_thérapeutique');
            $table->string('notice')->nullable();
            $table->string('img_produit')->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_santes');
    }
};
