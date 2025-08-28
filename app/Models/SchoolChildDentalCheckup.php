<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolChildDentalCheckup extends Model
{
    protected $table = 'school_child_dental_checkup';
    protected $fillable = [
        'pasien_id',
        'kondisi_karies',
        'kondisi_karang_gigi',
        'kondisi_gigi_goyang',
        'jumlah_gigi',
        'kondisi_sisa_akar',
        'saran_konsultasi',
        'saran_kontrol_rutin',
        'catatan',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
