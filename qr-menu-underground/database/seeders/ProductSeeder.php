<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['title' => 'Espresso', 'price' => 80.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Ice Latte', 'price' => 130.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Eldiven', 'price' => 300.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Kek', 'price' => 70.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Cappuccino', 'price' => 90.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Mocha', 'price' => 100.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Americano', 'price' => 85.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Flat White', 'price' => 95.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Ice Americano', 'price' => 120.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Ice Mocha', 'price' => 140.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Smoothie', 'price' => 150.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Limonata', 'price' => 80.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Saat', 'price' => 250.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Şapka', 'price' => 150.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Çanta', 'price' => 350.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Bileklik', 'price' => 120.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Kurabiye', 'price' => 50.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Muffin', 'price' => 60.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Sandviç', 'price' => 80.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Pasta', 'price' => 90.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Macchiato', 'price' => 85.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Double Espresso', 'price' => 95.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Ice Macchiato', 'price' => 135.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Milkshake', 'price' => 160.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Kolye', 'price' => 200.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Bardak', 'price' => 100.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Anahtarlık', 'price' => 50.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Broş', 'price' => 70.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Çörek', 'price' => 65.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Brownie', 'price' => 75.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Simit', 'price' => 30.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Donut', 'price' => 45.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Hot Chocolate', 'price' => 90.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Tea', 'price' => 70.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Ice Tea', 'price' => 100.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Frappe', 'price' => 150.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Bilezik', 'price' => 180.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Cüzdan', 'price' => 220.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Gözlük', 'price' => 300.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Anahtarlık', 'price' => 50.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Sarımsaklı Ekmek', 'price' => 60.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Mozarella Sticks', 'price' => 100.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Baget', 'price' => 110.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Croissant', 'price' => 120.00, 'category' => 'Atıştırmalıklar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Hot Mocha', 'price' => 110.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'White Chocolate Mocha', 'price' => 120.00, 'category' => 'Sıcak İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Ice White Chocolate Mocha', 'price' => 150.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Milk Tea', 'price' => 70.00, 'category' => 'Soğuk İçecekler', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Şarj Kablosu', 'price' => 50.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'USB Bellek', 'price' => 100.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Mouse Pad', 'price' => 80.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
            ['title' => 'Klavye', 'price' => 300.00, 'category' => 'Aksesuarlar', 'thumbnail'=> 'https://www.buseterim.com.tr/upload/default/2019/9/30/kahvehakkndabilmenizgerekenler680.jpg', 'body' => 'Buraya ürün ile ilgili açıklama yazısı gelecek.'],
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category'])->first();

            Product::create([
                'title' => $product['title'],
                'price' => $product['price'],
                'category_id' => $category->id,
                'thumbnail' => $product['thumbnail'],
                'body' => $product['body'],
            ]);
        }
    }
}
