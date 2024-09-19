<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Developer', 'email' => 'developer@harpysocial.com', 'password' => 'Yakup@Laravel44'],
            ['name' => 'Developer', 'email' => 'argent@harpysocial.com', 'password' => 'OnurLaravel'],
            ['name' => 'Underground', 'email' => 'underground@harpysocial.com', 'password' => 'uzay'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
