<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin RSABHK',
                'nip' => '202510001234',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
                'created_at' => now(),
            ],
            [
                'name' => 'Pegawai RSABHK',
                'nip' => '202510001235',
                'password' => Hash::make('worker123'),
                'role' => 'worker',
                'is_active' => true,
                'created_at' => now(),
            ],
        ];

        User::insert($user);
    }
}
