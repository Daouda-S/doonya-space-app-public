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
        Schema::create('espace_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('espace_id')->unsigned();
            $table->bigInteger('option_id')->unsigned();
            $table->foreign('espace_id')->references('id')->on('espaces')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espace_options');
    }
};
