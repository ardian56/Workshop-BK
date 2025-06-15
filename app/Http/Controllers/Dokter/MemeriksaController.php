<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JanjiPeriksa;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;

class MemeriksaController extends Controller
{
    public function index()
    {
        $janjis = JanjiPeriksa::with(['pasien', 'jadwalPeriksa'])
            ->whereHas('jadwalPeriksa', function ($query) {
                $query->where('id_dokter', Auth::id());
            })
            ->whereDoesntHave('periksa')
            ->get();
        return view('dokter.memeriksa.index', compact('janjis'));
    }

    public function create(JanjiPeriksa $janji)
    {
        $obats = Obat::all();
        return view('dokter.memeriksa.create', compact('janji', 'obats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_janji_periksa' => 'required|exists:janji_periksas,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat_ids' => 'nullable|array',
            'obat_ids.*' => 'exists:obats,id',
        ]);

        $biaya_pemeriksaan = 100000;

        $total_harga_obat = 0;
        $selectedObatIds = array_filter($validated['obat_ids'] ?? []);

        if (!empty($selectedObatIds)) {
            $total_harga_obat = Obat::whereIn('id', $selectedObatIds)->sum('harga');
        }

        $total_biaya = $biaya_pemeriksaan + $total_harga_obat;

        $periksa = Periksa::create([
            'id_janji_periksa' => $validated['id_janji_periksa'],
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $total_biaya,
        ]);

        if (!empty($selectedObatIds)) {
            foreach ($selectedObatIds as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }
        }
        return redirect()->route('dokter.memeriksa.index')->with('status', 'Pemeriksaan berhasil dibuat.');
    }
}