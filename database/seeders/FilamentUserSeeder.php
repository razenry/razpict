<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Sesuaikan dengan model User yang digunakan Filament
use Illuminate\Support\Facades\Hash;

class FilamentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Razenry',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
        ]);
    }
}
