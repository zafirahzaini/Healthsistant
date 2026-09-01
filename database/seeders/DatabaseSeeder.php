<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'userID'               => 'ADM001',
            'name'                 => 'Admin User',
            'email'                => 'admin@gmail.com',
            'password'             => Hash::make('Admin123!'),
            'age'                  => 30,
            'role'                 => 'Admin',
            'must_change_password' => 0,
            'available_status'     => 'Available',
        ]);
    }
}