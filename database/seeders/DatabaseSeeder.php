<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\VehicleSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            VehicleSeeder::class,
        ]);
    }
}
