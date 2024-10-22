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
        Schema::create('imputabilites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traitement_id')->unique()->constrained();
            $table->enum('classification',["Certain","Probable","Possible","Improbable","Conditionnelle / Non classée","Non évaluable / Non classée","Non lié","Lien indéterminé"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imputabilites');
    }
};
