<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan pengguna biasa
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            'avatar' => null, // Ganti jika ada avatar
            'role' => 'user', // Pastikan ada kolom role di tabel users
            'email_verified_at' => now(), // Set email_verified_at untuk menandakan terverifikasi
        ]);

        // Tambahkan admin yang terverifikasi
        User::create([
            'name' => 'Siti Nur Hanifah',
            'email' => 'hanifahhanif835@gmail.com',
            'password' => Hash::make('alhamdulillah'), // Ganti dengan password yang aman
            'avatar' => null, // Ganti jika ada avatar
            'role' => 'admin', // Pastikan ada kolom role di tabel users
            'email_verified_at' => now(), // Set email_verified_at untuk menandakan terverifikasi
        ]);
    }
}
