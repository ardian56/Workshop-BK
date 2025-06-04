<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $dokter = User::where('role', 'dokter')->first();
         $jadwals = [
            [
                'id_dokter' => $dokter->id,
                'hari' => 'Senin',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '12:00:00',
                'status' => true,
            ],
            [
                'id_dokter' => $dokter->id,
                'hari' => 'Selasa',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '13:00:00',
                'status' => true,
            ],
            [
                'id_dokter' => $dokter->id,
                'hari' => 'Rabu',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '14:00:00',
                'status' => false,
            ],
            [
                'id_dokter' => $dokter->id,
                'hari' => 'Kamis',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '17:00:00',
                'status' => true,
            ],
            [
                'id_dokter' => $dokter->id,
                'hari' => 'Jumat',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '16:00:00',
                'status' => true,
            ],
        ];
        foreach ($jadwals as $jadwal) {
            JadwalPeriksa::create($jadwal);
        }
    }
}
