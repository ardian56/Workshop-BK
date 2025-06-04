<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obats = [
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet',
                'harga' => 3500,
            ],
            [
                'nama_obat' => 'Bodrex',
                'kemasan' => 'Tablet',
                'harga' => 2000,
            ],
            [
                'nama_obat' => 'Tolak Angin',
                'kemasan' => 'Sachet',
                'harga' => 4500,
            ],
            [
                'nama_obat' => 'Minyak Kayu Putih',
                'kemasan' => 'Botol',
                'harga' => 18000,
            ],
        ];
        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}
