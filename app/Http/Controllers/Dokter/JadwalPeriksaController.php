<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::id())
                                    ->get()
                                    ->sortBy(function($schedule) {
                                        $daysOrder = [
                                            'Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4,
                                            'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7
                                        ];
                                        return $daysOrder[$schedule->hari] . $schedule->jam_mulai;
                                    });

        return view('dokter.jadwalperiksa.index', compact('jadwalPeriksas'));
    }

    public function create()
    {
        return view('dokter.jadwalperiksa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|boolean',
        ]);

        if ($request->status == true) {
            JadwalPeriksa::where('id_dokter', Auth::id())
                         ->where('status', true)
                         ->update(['status' => false]);
        }

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwalperiksa-created');
    }

    public function toggleStatus(Request $request, $id)
    {
        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
                                      ->where('id_dokter', Auth::id())
                                      ->firstOrFail();

        if (!$jadwalPeriksa->status) { 
            JadwalPeriksa::where('id_dokter', Auth::id())
                         ->where('id', '!=', $jadwalPeriksa->id)
                         ->where('status', true) 
                         ->update(['status' => false]);
        }

        $jadwalPeriksa->status = !$jadwalPeriksa->status;
        $jadwalPeriksa->save();

        return back()->with('status', 'jadwalperiksa-updated');
    }
}

