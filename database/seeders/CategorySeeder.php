<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Soğuk İçecekler',
                'icon' => 'fa-regular fa-snowflake',
                'color' => '#005AC8',
            ],
            [
                'name' => 'Sıcak İçecekler',
                'icon' => 'fa-solid fa-fire-flame-curved',
                'color' => '#B40000',
            ],
            [
                'name' => 'Mocktailler',
                'icon' => 'fa-solid fa-wine-glass-empty',
                'color' => '#B40000',
            ],
            [
                'name' => 'Atıştırmalıklar',
                'icon' => 'fa-solid fa-burger',
                'color' => '#A35200',
            ],
            [
                'name' => 'Ekstralar',
                'icon' => 'fa-solid fa-bolt-lightning',
                'color' => '#120A8F',
            ],
            [
                'name' => 'Abur Cuburlar',
                'icon' => 'fa-solid fa-cookie-bite',
                'color' => '#A35200',
            ],
            [
                'name' => 'Aksesuarlar',
                'icon' => 'fa-solid fa-motorcycle',
                'color' => '#000000',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
