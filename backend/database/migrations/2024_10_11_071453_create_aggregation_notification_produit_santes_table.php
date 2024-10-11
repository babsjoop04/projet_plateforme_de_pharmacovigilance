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
        Schema::create('aggregation_notification_produit_santes', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('notification_id')->constrained();
            $table->foreignId('produit_sante_id')->constrained();
            $table->primary(['notification_id', 'produit_sante_id']);

            
            //eeim
            $table->text('posologie')->nullable();
            $table->date('date_debut_prise')->nullable();
            $table->date('date_fin_prise')->nullable();
            //mapi
            $table->date('date_ouverture_flacon')->nullable();
            $table->date('date_vaccination')->nullable();
            $table->string('site_administration')->nullable();
            $table->integer('nombre_contact_vaccin')->nullable();
            $table->string('nom_solvant')->nullable();
            $table->date('date_peremption_solvant')->nullable();
            $table->string('numero_lot_solvant')->nullable();
//donnee commune
            $table->string('numero_lot');
            $table->string('provenance');
            $table->date('date_peremption');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aggregation_notification_produit_santes');
    }
};
