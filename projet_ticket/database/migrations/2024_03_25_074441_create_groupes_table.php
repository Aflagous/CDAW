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
        Schema::create('groupes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('joueur_id');
            $table->unsignedBigInteger('partie_id'); // Ajout de la colonne partie_id
            $table->text('couleur');
            $table->foreign('partie_id', 'partie')->references('id')->on('parties');
            $table->foreign('joueur_id', 'joueur')->references('id')->on('users');
    
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupes');
    }
};
