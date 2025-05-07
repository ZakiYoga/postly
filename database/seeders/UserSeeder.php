<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Zaki Satria Prayoga',
            'username' => 'zakistr',
            'email' => 'zaki.satriapr@gmail.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'name' => 'user1',
            'username' => 'user-1',
            'email' => 'user@example.com',
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
        User::factory(6)->create();
    }
}
