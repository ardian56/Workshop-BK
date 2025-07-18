<?php

namespace App\Http\Controllers\Dokter;
use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        $obatsTrashed = Obat::onlyTrashed()->get();
        return view('dokter.obat.index', compact('obats', 'obatsTrashed'));
    }

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function edit($id)
    {
        $obat = Obat::find($id);
        return view('dokter.obat.edit')->with([
            'obat' => $obat,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga'    => 'required|numeric|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-created');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
        ]);

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-updated');
    }

    // Soft delete obat
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->back()->with('status', 'Obat berhasil dihapus (soft delete).');
    }

    // Restore obat yang terhapus
    public function restore($id)
    {
        $obat = \App\Models\Obat::withTrashed()->findOrFail($id);
        $obat->restore();
        return redirect()->route('dokter.obat.trash')->with('status', 'Obat berhasil direstore.');
    }

    public function trash()
    {
        $obatsTrashed = \App\Models\Obat::onlyTrashed()->get();
        return view('dokter.obat.trash', compact('obatsTrashed'));
    }
}