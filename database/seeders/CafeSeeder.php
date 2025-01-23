<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CafeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cafes')->insert([
            'name' => 'Underground',
            'phone' => '+90 (544) 278 35 43',
            'address' => 'Kartaltepe Mah. Gençler Cd. No: 2B Bakirköy/İstanbul',
            'address_link' => 'https://g.co/kgs/iJPTUCx',
            'insta_name' => 'undergroundcoffee.shop',
            'insta_link' => 'https://www.instagram.com/undergroundcoffee.shop',
            'description' => '"Şehrin gizli cenneti; Yeraltı Kahve Evi"',
            'opening_time' => '10:00',
            'closing_time' => '23:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
