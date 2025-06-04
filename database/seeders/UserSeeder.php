<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =[
            [
            'role' => 'dokter',
            'nama' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'password' => Hash::make('password123'),
            'alamat' => 'Jl. Merdeka No. 10, Jakarta',
            'no_ktp' => '3210000000000001',
            'no_hp' => '081234567890',
            'poli' => 'Umum',
            ],
            [
            'role' => 'pasien',
            'nama' => 'Siti Aminah',
            'email' => 'siti.aminah@example.com',
            'alamat' => 'Jl. Pahlawan No. 5, Bandung',
            'no_ktp' => '3210000000000002',
            'no_hp' => '081234567891',
            'poli' => 'Umum',
            'password' => Hash::make('password123'),
            ],
        ];
         foreach ($users as $user) {
            User::create($user);
        }
    }
}
