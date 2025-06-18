<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPeriksaController extends Controller
{
    // Function() lain ....
    public function index()
    {
        $no_rm = Auth::user()->no_rm;

        $janjiPeriksas = JanjiPeriksa::with([
            'periksa', 
            'jadwalPeriksa.dokter.poli' 
        ])->where('id_pasien', Auth::user()->id)->get();

        return view('pasien.riwayatperiksa.index')->with([
            'no_rm' => $no_rm,
            'janjiPeriksas' => $janjiPeriksas,
        ]);
    }

    public function detail($id)
    {
        $janjiPeriksa = JanjiPeriksa::with([
            'jadwalPeriksa.dokter.poli', // Untuk mendapatkan nama poli dokter
            'periksa.detailPeriksas.obat' // Ini akan eager load Periksa, DetailPeriksa-nya, dan Obat-nya
        ])->findOrFail($id);

        return view('pasien.riwayatperiksa.detail')->with([
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }

    public function riwayat($id)
    {
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa.dokter'])->findOrFail($id);
        $riwayat = $janjiPeriksa->riwayatPeriksa; 

        return view('pasien.riwayatperiksa.riwayat')->with([
            'riwayat' => $riwayat,
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }
}