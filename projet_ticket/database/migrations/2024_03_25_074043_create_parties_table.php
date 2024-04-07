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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->boolean('publique')->default(false);
            $table->unsignedInteger('temps');
            $table->text('mdp')->nullable();
            $table->unsignedBigInteger('hote_id');
            $table->foreign('hote_id', 'hote')->references('id')->on('users');
            $table->boolean('commencer')->default(false);
            $table->boolean('fini')->default(false);
            $table->boolean('debut')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
