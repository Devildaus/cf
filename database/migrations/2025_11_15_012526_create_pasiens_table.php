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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('umur')->nullable();
            $table->float('akumulasi_cf')->nullable();
            $table->float('persentase')->nullable();
            $table->foreignId('penyakit_id')->nullable();
            $table->string('nama_penyakit')->nullable();

            // Log Integrasi n8n & WhatsApp (Request Anda: sebelum & sesudah diolah)
            $table->json('pesan_input')->nullable()->comment('Data mentah JSON yang dikirim ke n8n');
            $table->text('pesan_output')->nullable()->comment('Pesan final hasil olahan n8n yang dikirim ke WA');
            
            // Cache Hasil AI (Agar tidak generate ulang terus menerus)
            $table->text('deskripsi_ai')->nullable();
            $table->text('penanganan_ai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
