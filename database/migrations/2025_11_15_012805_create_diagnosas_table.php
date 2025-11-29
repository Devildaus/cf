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
        Schema::create('diagnosas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->nullable();
            $table->foreignId('gejala_id')->nullable();
            $table->foreignId('penyakit_id')->nullable();
            $table->decimal('nilai_cf', 3, 2)->nullable(); // <-- Diperbaiki
            $table->decimal('cf_hasil', 3, 2)->nullable(); // <-- Diperbaiki
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosas');
    }
};
