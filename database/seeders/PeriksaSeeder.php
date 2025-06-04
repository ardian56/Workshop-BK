<?php

namespace Database\Seeders;

use App\Models\JanjiPeriksa;
use App\Models\Periksa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $janji = JanjiPeriksa::first();
        $data = [
            [
                'id_janji_periksa' => $janji->id,
                'tgl_periksa' => now(), 
                'catatan' => 'Pasien mengalami demam ringan, disarankan istirahat dan diberi obat penurun panas.',
                'biaya_periksa' => 75000,
            ],
            [
                'id_janji_periksa' => $janji->id,
                'tgl_periksa' => now()->addDays(2), 
                'catatan' => 'Kondisi pasien membaik, batuk berkurang. Resep vitamin.',
                'biaya_periksa' => 50000,
            ],
            [
                'id_janji_periksa' => $janji->id,
                'tgl_periksa' => now()->addDays(5),
                'catatan' => 'Nyeri sendi berkurang, perlu fisioterapi ringan.',
                'biaya_periksa' => 60000,
            ],
        ];

        foreach ($data as $item) {
            Periksa::create($item);
        }

    }
}
