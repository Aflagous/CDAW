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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->integer('couleur');
            $table->integer('nombre');
            $table->boolean('active')->default(false);
            $table->foreignId('id_partie')->constrained('parties'); 
            $table->foreignId('joueur_id')->constrained('users'); 
            $table->integer('longueur'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
