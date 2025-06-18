<?php

namespace Database\Seeders;
use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $poli = [
            [
                'nama_poli' => 'Poli Gigi',
                'deskripsi' => 'Poli khusus untuk perawatan gigi dan mulut.',
            ],
            [
                'nama_poli' => 'Poli Anak',
                'deskripsi' => 'Poli khusus untuk perawatan anak-anak.',
            ],
            [
                'nama_poli' => 'Poli Penyakit Dalam',
                'deskripsi' => 'Poli untuk penanganan penyakit dalam.',
            ]
        ];
        foreach ($poli as $item) {
            Poli::create($item);
        }
    }
}
