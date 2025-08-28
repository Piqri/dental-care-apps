<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'nik',
        'nama_orang_tua',
        'alamat',
        'no_wa',
        'jenis_kelamin',
        'jenis_pasien',
    ];

    public function pregnantDentalCheckups()
    {
        return $this->hasMany(PregnantDentalCheckup::class);
    }

    public function catenDentalCheckups()
    {
        return $this->hasMany(CatenDentalCheckup::class);
    }

    public function schoolChildDentalCheckups()
    {
        return $this->hasMany(SchoolChildDentalCheckup::class);
    }

    public function getUmurAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_lahir)->age;
    }
}
