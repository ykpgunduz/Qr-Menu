<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CafeSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
            CafeSeeder::class,
        ]);
    }
}
