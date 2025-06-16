<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'username' => 'admin', // Provide a username here
        ]);
        

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'username' => 'editor', // Provide a username here
            'password' => Hash::make('password'),
            'role' => 'editor',

        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'username' => 'user', // Provide a username here
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
