<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Hapus data yang ada sebelumnya
        DB::table('users')->truncate();

        // Masukkan data pengguna contoh
        User::create([
            'name' => 'Admin',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'testing@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // Tambahkan pengguna lain sesuai kebutuhan
    }
}
