<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatenDentalCheckup extends Model
{
    protected $table = 'caten_dental_checkup';
    protected $fillable = [
        'pasien_id',
        'gigi_berlubang',
        'riwayat_sakit_gigi',
        'terakhir_sakit_gigi',
        'gusi_bengkak',
        'sisa_akar',
        'gusi_berdarah',
        'gigi_goyang',
        'sariawan',
        'kondisi_karies',
        'kondisi_sisa_akar',
        'kondisi_karang_gigi',
        'kondisi_gusi_bengkak',
        'kondisi_gigi_goyang',
        'kondisi_pendarahan',
        'saran_konsultasi',
        'saran_kontrol_rutin',
        'catatan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
