<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // User::factory(10)->create();

        User::updateOrCreate([
            'email' => 'admin@sarana.test',
        ], [
            'username' => 'admin',
            'nis' => '0000000001',
            'kelas' => 'STAFF',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::updateOrCreate([
            'email' => 'siswa@sarana.test',
        ], [
            'username' => 'siswa',
            'nis' => '0000000002',
            'kelas' => 'X-A',
            'role' => 'siswa',
            'password' => Hash::make('password'),
        ]);
    }
}
