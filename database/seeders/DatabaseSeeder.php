<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'userID'               => 'OM001',
            'name'                 => 'Admin',
            'email'                => 'admin@gmail.com',
            'password'             => 'Admin123!',
            'age'                  => 30,
            'role'                 => 'operation manager',
            'must_change_password' => 0,
            'available_status'     => null,
        ]);
    }
}