<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'username' => 'adminuser',
            'password' => Hash::make('adminpassword'), // Make sure to hash the password
            'role' => 'admin',
        ]);

        // Create 2 normal users
        User::create([
            'username' => 'normaluser1',
            'password' => Hash::make('normalpassword1'), // Make sure to hash the password
            'role' => 'user',
        ]);

        User::create([
            'username' => 'normaluser2',
            'password' => Hash::make('normalpassword2'), // Make sure to hash the password
            'role' => 'user',
        ]);
    }
}