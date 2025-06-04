<?php

namespace Database\Seeders;

use App\Models\DetailPeriksa;
use App\Models\JadwalPeriksa;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
            ObatSeeder::class,
            UserSeeder::class,
            JadwalPeriksaSeeder::class,
            JanjiPeriksaSeeder::class,
            PeriksaSeeder::class,
            DetailPeriksaSeeder::class,
            DokterSeeder::class,
       ]);
    }
}
