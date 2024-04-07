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
        Schema::create('jetons', function (Blueprint $table) {
            $table->id();
            $table->string('lien')->nullable(); 
            $table->integer('nombre'); 
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
        Schema::dropIfExists('jetons');
    }
};
