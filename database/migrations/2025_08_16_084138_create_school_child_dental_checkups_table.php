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
        Schema::create('school_child_dental_checkup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id');

            $table->boolean('kondisi_karies')->default(false);
            $table->boolean('kondisi_karang_gigi')->default(false);
            $table->boolean('kondisi_gigi_goyang')->default(false);
            $table->enum('jumlah_gigi', ['normal', 'berlebih', 'kurang'])->default('normal');
            $table->boolean('kondisi_sisa_akar')->default(false);

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
        Schema::dropIfExists('school_child_dental_checkup');
    }
};
