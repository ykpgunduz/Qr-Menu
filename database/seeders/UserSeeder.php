<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Developer', 'email' => 'developer@harpysocial.com', 'password' => 'Yakup@Laravel44'],
            ['name' => 'Developer', 'email' => 'argent@harpysocial.com', 'password' => 'OnurLaravel'],
            ['name' => 'Underground', 'email' => 'underground@harpysocial.com', 'password' => 'uzay'],
        ];

        foreach ($users as $user) {
            // Kullanıcıyı oluşturuyoruz
            $createdUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            // Bildirim ilişkisinin oluşturulması
            // notifiable_type'ı 'App\Models\User' olarak ayarlıyoruz ve notifiable_id olarak kullanıcının id'sini veriyoruz
            // $createdUser->notifiable()->create([
            //     'notifiable_type' => 'App\Models\User',
            //     'notifiable_id' => $createdUser->id,
            // ]);
        }
    }
}
