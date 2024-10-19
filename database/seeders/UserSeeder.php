<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'testing24@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
        // akun kasir
        User::create([
            'name' => 'Kasir',
            'email' => 'testing14@gmail.com',
            'role' => 'kasir',
            'password' => Hash::make('kasir123'),
        ]);
    }
}
