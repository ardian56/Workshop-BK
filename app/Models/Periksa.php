<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPeriksa;

class Periksa extends Model
{
    protected $fillable = [
        'id_janji_periksa',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    public function janjiPeriksa()
    {
        return $this->belongsTo(JanjiPeriksa::class, 'id_janji_periksa');
    }

    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
}
