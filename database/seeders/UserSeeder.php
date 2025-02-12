<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role_id' => 1
            ],
            [
                'name' => 'editor',
                'email' => 'editor@editor.com',
                'password' => Hash::make('password'),
                'role_id' => 2
            ],
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
                'role_id' => 3
            ],
        ]);
    }
}
