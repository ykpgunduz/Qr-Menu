<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['title' => 'Espresso Ristretto', 'price' => 75.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Espresso Single', 'price' => 75.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Espresso Decaf', 'price' => 85.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Espresso Double', 'price' => 90.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Espresso Lungo', 'price' => 95.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Espresso Macchiato', 'price' => 95.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Americano', 'price' => 100.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Filtre Kahve', 'price' => 110.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Filtre Kahve Decaf', 'price' => 115.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Cappucino', 'price' => 125.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Cortado', 'price' => 110.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Flat White', 'price' => 115.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Latte Macchiato', 'price' => 125.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Underground Latte', 'price' => 140.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Cafe Latte', 'price' => 120.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Aromalı Latte', 'price' => 135.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Iced Americano', 'price' => 120.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Iced Filter', 'price' => 130.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Iced Latte', 'price' => 130.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Aromalı Iced Latte', 'price' => 145.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Iced Mocha/Aromalılar', 'price' => 140.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Frappe/Aromalılar', 'price' => 145.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Iced Underground', 'price' => 155.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Iced Chai Tea Latte', 'price' => 150.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Iced Matcha Latte', 'price' => 170.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Iced Chocolate', 'price' => 160.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Iced Salepso', 'price' => 165.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Espresso Con Panna', 'price' => 95.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Affogato', 'price' => 105.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Cafe Miel', 'price' => 110.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Chai Tea Latte', 'price' => 125.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Matcha Latte', 'price' => 160.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Sıcak Çikolata', 'price' => 145.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Salep', 'price' => 130.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Mocha ve Çeşitleri', 'price' => 135.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Türk Kahvesi', 'price' => 90.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Double Türk Kahvesi', 'price' => 130.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Damla Sakızlı Türk Kahve', 'price' => 95.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Double Damla Sakızlı Türk Kahve', 'price' => 135.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Menengiç Türk Kahve', 'price' => 100.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Double Menengiç Türk Kahve', 'price' => 140.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Dibek Türk Kahve', 'price' => 95.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Double Dibek Türk Kahve', 'price' => 135.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Meyveli Çaylar', 'price' => 40.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Organik Çaylar', 'price' => 95.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Klasik Çay', 'price' => 30.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Fincan Çay', 'price' => 50.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Take Away Çay', 'price' => 70.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Sınırsız Çay', 'price' => 100.00, 'category' => 'Sıcak İçecekler'],
            ['title' => 'Milkshake Çeşitleri', 'price' => 155.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Smoothie Çeşitleri', 'price' => 160.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Frozen Çeşitleri', 'price' => 165.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Limonata', 'price' => 100.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Sıkma Portakal Suyu', 'price' => 140.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Coca Cola', 'price' => 80.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Coca Cola Zero', 'price' => 80.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Beyoğlu Gazoz', 'price' => 80.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Beyoğlu Gazoz Zencefil', 'price' => 80.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Su', 'price' => 30.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Maden Suyu Soda', 'price' => 50.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Churchill', 'price' => 70.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Enerji Monster', 'price' => 90.00, 'category' => 'Soğuk İçecekler'],
            ['title' => 'Cheesecake Limon/Frambuaz', 'price' => 130.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Tiramisu', 'price' => 140.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Çikolatalı Tatlı', 'price' => 145.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Bardak Kurabiye', 'price' => 80.00, 'category' => 'Atıştırmalıklar'],
            ['title' => '3 Top Dondurma', 'price' => 120.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Mono Latte Pasta', 'price' => 135.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Kaşarlı Tost', 'price' => 110.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Sucuklu Tost', 'price' => 120.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Jambonlu Sandivich', 'price' => 130.00, 'category' => 'Atıştırmalıklar'],
            ['title' => '3 Peynirli Sandivich', 'price' => 120.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Corn Flakes Çeşitleri', 'price' => 100.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Şıpsevdi', 'price' => 5.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'TopiTop', 'price' => 20.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Haribo', 'price' => 15.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Mabel', 'price' => 25.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Wafer Master', 'price' => 10.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Hanuta', 'price' => 45.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Hobby', 'price' => 20.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Bahçeden Fındıklı Bar', 'price' => 35.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Bahçeden Fıstıklı Bar', 'price' => 35.00, 'category' => 'Atıştırmalıklar'],
            ['title' => 'Çokokrem', 'price' => 45.00, 'category' => 'Atıştırmalıklar'],
        ];

        foreach ($products as $product) {
            $category = Category::firstOrCreate(['name' => $product['category']]);

            Product::create([
                'title' => $product['title'],
                'price' => $product['price'],
                'category_id' => $category->id,
            ]);
        }
    }
}
