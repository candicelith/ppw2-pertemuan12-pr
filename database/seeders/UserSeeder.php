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
            'name' => 'testAdmin',
            'email' => 'testingAdmin@gmail.com',
            'level' => 'admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
