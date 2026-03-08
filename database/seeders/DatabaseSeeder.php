<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User 1',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test2@example.com'],
            [
                'name' => 'Test User 2',
                'password' => Hash::make('password'),
            ]
        );
    }
}
