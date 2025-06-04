<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JanjiPeriksa extends Model
{
    protected $fillable = [
        'id_pasien',
        'id_jadwal_periksa',
        'keluhan',
        'no_antrian',
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal_periksa');
    }

    public function periksa()
    {
        return $this->hasOne(Periksa::class, 'id_janji_periksa');
    }
}
