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
            ['name' => 'Yakup', 'email' => 'yakup@admin.com', 'password' => 'asd'],
            ['name' => 'Onur', 'email' => 'onur@admin.com', 'password' => 'asd'],
            ['name' => 'Uzay', 'email' => 'uzay@admin.com', 'password' => 'asd'],
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
