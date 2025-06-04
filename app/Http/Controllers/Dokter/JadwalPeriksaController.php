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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil jadwal periksa yang dibuat oleh dokter yang sedang login
        // Asumsi: user yang login adalah dokter dan id_dokter di tabel jadwal_periksas adalah id user
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', Auth::id())
                                    ->get() // Dapatkan koleksi sebelum sortBy
                                    ->sortBy(function($schedule) {
                                        $daysOrder = [
                                            'Senin' => 1, 'Selasa' => 2, 'Rabu' => 3, 'Kamis' => 4,
                                            'Jumat' => 5, 'Sabtu' => 6, 'Minggu' => 7
                                        ];
                                        return $daysOrder[$schedule->hari] . $schedule->jam_mulai;
                                    });

        // Menggunakan with() seperti contoh ObatController
        return view('dokter.jadwalperiksa.index')->with([
            'jadwalPeriksas' => $jadwalPeriksas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tidak perlu mengambil daftar dokter, karena jadwal akan otomatis dikaitkan dengan user yang login
        return view('dokter.jadwalperiksa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|boolean',
        ]);

        // Jika jadwal baru diaktifkan, nonaktifkan jadwal lain untuk dokter ini
        if ($request->status == true) {
            JadwalPeriksa::where('id_dokter', Auth::id())
                         ->where('status', true)
                         ->update(['status' => false]);
        }

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(), // Mengambil ID user yang sedang login secara otomatis
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status, // Menggunakan status dari input form
        ]);

        // Menggunakan with('status') seperti contoh ObatController
        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwalperiksa-created');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari jadwal periksa berdasarkan ID dan pastikan itu milik dokter yang login
        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
                                      ->where('id_dokter', Auth::id())
                                      ->firstOrFail();

        // Menggunakan with() seperti contoh ObatController
        return view('dokter.jadwalperiksa.edit')->with([
            'jadwalPeriksa' => $jadwalPeriksa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari jadwal periksa berdasarkan ID dan pastikan itu milik dokter yang login
        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
                                      ->where('id_dokter', Auth::id())
                                      ->firstOrFail();

        $request->validate([
            'hari' => 'required|string|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|boolean',
        ]);

        // Jika jadwal ini akan diaktifkan, nonaktifkan jadwal lain untuk dokter ini
        if ($request->status == true && !$jadwalPeriksa->status) { // Hanya jika status berubah dari nonaktif ke aktif
            JadwalPeriksa::where('id_dokter', Auth::id())
                         ->where('id', '!=', $jadwalPeriksa->id)
                         ->where('status', true)
                         ->update(['status' => false]);
        }

        $jadwalPeriksa->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        // Menggunakan with('status') seperti contoh ObatController
        return redirect()->route('dokter.jadwalperiksa.index')->with('status', 'jadwalperiksa-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari jadwal periksa berdasarkan ID dan pastikan itu milik dokter yang login
        $jadwalPeriksa = JadwalPeriksa::where('id', $id)
                                      ->where('id_dokter', Auth::id())
                                      ->firstOrFail();

        $jadwalPeriksa->delete();

        // Menggunakan redirect tanpa with('status') seperti contoh ObatController
        return redirect()->route('dokter.jadwalperiksa.index');
    }

    // Metode toggleStatus tetap ada karena ini spesifik untuk jadwal
    public function toggleStatus(Request $request, string $id)
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

