<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PastOrder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PastOrdersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $products = [
            ['name' => 'Espresso', 'price' => 100], // 5 times the original price
            ['name' => 'Cappuccino', 'price' => 125],
            ['name' => 'Latte', 'price' => 150],
            ['name' => 'Americano', 'price' => 110],
            ['name' => 'Mocha', 'price' => 140],
            ['name' => 'Macchiato', 'price' => 130],
            ['name' => 'Tea', 'price' => 75],
            ['name' => 'Hot Chocolate', 'price' => 135],
            ['name' => 'Flat White', 'price' => 145],  // New products added
            ['name' => 'Iced Coffee', 'price' => 120],
            ['name' => 'Green Tea', 'price' => 85],
            ['name' => 'Chai Latte', 'price' => 155],
            ['name' => 'Matcha Latte', 'price' => 160],
            ['name' => 'Turkish Coffee', 'price' => 90],
            ['name' => 'Affogato', 'price' => 200],
        ];

        $tableNumbers = range(1, 20); // Assuming there are 20 tables
        $startOfYear = Carbon::create(2024, 1, 1);
        $endOfYear = Carbon::create(2024, 12, 31);

        foreach (range(1, 3000) as $index) { // Increase to 3000 records
            $sessionId = $faker->uuid;
            $tableNumber = $faker->randomElement($tableNumbers);
            $createdAt = $faker->dateTimeBetween($startOfYear, $endOfYear);

            // Generate 1 to 8 products per session
            $productCount = rand(1, 8);
            $totalAmount = 0;

            foreach (range(1, $productCount) as $productIndex) {
                $product = $faker->randomElement($products);
                $quantity = rand(1, 5); // Increase max quantity
                $price = $product['price'];
                $total = $price * $quantity;

                PastOrder::create([
                    'session_id' => $sessionId,
                    'table_number' => $tableNumber,
                    'total_amount' => $total, // This is for the individual product, to calculate the session total
                    'product_name' => $product['name'],
                    'quantity' => $quantity,
                    'price' => $price,
                    'created_at' => $createdAt,
                ]);

                $totalAmount += $total;
            }

            // Update the total_amount for the session
            PastOrder::where('session_id', $sessionId)
                ->update(['total_amount' => $totalAmount]);
        }
    }
}
