<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PregnantDentalCheckup extends Model
{
    protected $table = 'pregnant_dental_checkup';
    protected $fillable = [
        'pasien_id',
        'gigi_berdarah',
        'gusi_bengkak',
        'dikomentari_bau_mulut',
        'gigi_goyang',
        'sulit_mengunyah',
        'makanan_terselip',
        'gusi_sakit',
        'gigi_sakit',
        'keluhan_lain',
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
