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
        User::firstOrCreate(
            ['username' => 'opalopal09'],
            [
                'nama_lengkap' => 'Opal Owner',
                'password' => 'opal123ya',
                'role' => 'admin',
                'status_aktif' => 'aktif'
            ]
        );

        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'nama_lengkap' => 'Admin Parkir',
                'password' => 'admin123',
                'role' => 'admin',
                'status_aktif' => 'aktif'
            ]
        );

        User::firstOrCreate(
            ['username' => 'petugas'],
            [
                'nama_lengkap' => 'Petugas Parkir',
                'password' => 'petugas123',
                'role' => 'petugas',
                'status_aktif' => 'aktif'
            ]
        );

        User::firstOrCreate(
            ['username' => 'owner'],
            [
                'nama_lengkap' => 'Owner Parkir',
                'password' => 'owner123',
                'role' => 'owner',
                'status_aktif' => 'aktif'
            ]
        );
    }
}
