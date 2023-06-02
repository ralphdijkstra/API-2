<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name' => 'ralph',
            'email' => 'ralph@summa.nl',
            'password' => 'password',
        ]);
        $this->call(MovieSeeder::class);
        $this->call(TrailerSeeder::class);
    }
}
