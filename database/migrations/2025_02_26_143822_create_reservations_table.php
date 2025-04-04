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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('espace_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('espace_id')->references('id')->on('espaces');
            $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('dateDebut')->nullable(false); // Date et heure de début de la réservation
            $table->dateTime('dateFin')->nullable(false);
            $table->integer('prix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};

