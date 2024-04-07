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
        Schema::create('jen_cours', function (Blueprint $table) {
            $table->id();
            $table->integer('pioche')->default(0)->nullable();
            $table->integer('pioche_2')->default(0)->nullable();
            $table->foreignId('id_partie')->constrained('parties'); 
            $table->foreignId('joueur_id')->constrained('users'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jen_cours');
    }
};
