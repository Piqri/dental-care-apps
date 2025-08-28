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
        Schema::create('caten_dental_checkup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');
            $table->string('gigi_berlubang')->nullable();
            $table->string('riwayat_sakit_gigi')->nullable();
            $table->date('terakhir_sakit_gigi')->nullable();
            $table->string('gusi_bengkak')->nullable();
            $table->string('sisa_akar')->nullable();
            $table->string('gusi_berdarah')->nullable();
            $table->string('gigi_goyang')->nullable();
            $table->string('sariawan')->nullable();

            $table->boolean('kondisi_karies')->default(false);
            $table->boolean('kondisi_sisa_akar')->default(false);
            $table->boolean('kondisi_karang_gigi')->default(false);
            $table->boolean('kondisi_gusi_bengkak')->default(false);
            $table->boolean('kondisi_gigi_goyang')->default(false);
            $table->boolean('kondisi_pendarahan')->default(false);

             $table->string('saran_konsultasi')->nullable();
            $table->string('saran_kontrol_rutin')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->foreign('pasien_id')->references('id')->on('pasien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caten_dental_checkup');
    }
};
