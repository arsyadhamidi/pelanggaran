<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'level' => 'Super Admin',
            'telp' => '082389882323',
        ]);
    }
}
