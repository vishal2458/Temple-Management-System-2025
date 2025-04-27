<?php

namespace Database\Seeders;

use App\Models\User;
use CountriesTableSeeder;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CitiesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            StatesTableSeeder::class,
            CitiesTableSeeder::class,
            ImpDataSeeder::class
        ]);
        // User::factory(10)->create();
    }
}
