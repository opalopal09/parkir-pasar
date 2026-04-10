<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only seed if no users exist
        if (User::count() > 0) {
            return;
        }

        User::create([
            'nama_lengkap' => 'Admin Parkir',
            'username' => 'admin',
            'password' => 'admin123',
            'role' => 'admin',
            'status_aktif' => 'aktif'
        ]);

        User::create([
            'nama_lengkap' => 'Petugas Parkir',
            'username' => 'petugas',
            'password' => 'petugas123',
            'role' => 'petugas',
            'status_aktif' => 'aktif'
        ]);

        User::create([
            'nama_lengkap' => 'Owner Parkir',
            'username' => 'owner',
            'password' => 'owner123',
            'role' => 'owner',
            'status_aktif' => 'aktif'
        ]);
    }
}
