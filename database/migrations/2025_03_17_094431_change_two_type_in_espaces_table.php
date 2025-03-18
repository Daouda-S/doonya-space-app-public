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
        Schema::table('espaces', function (Blueprint $table) {
            $table->string('taille')->nullable()->change();
            $table->integer('capacite')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('espaces', function (Blueprint $table) {
            $table->integer('taille')->nullable()->change();
            $table->string('capacite')->nullable()->change();
        });
    }
};
