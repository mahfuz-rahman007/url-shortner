<?php

namespace Database\Seeders;

use App\Models\UrlShortener;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->count(20)->has(UrlShortener::factory()->count(100))->create();
    }
}
