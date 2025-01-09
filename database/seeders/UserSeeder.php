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
            ['name' => 'Developer', 'email' => 'developer@harpysocial.com', 'password' => 'asd'],
            ['name' => 'Kasa', 'email' => 'kasa@harpysocial.com', 'password' => 'Kasa123',  ],
            ['name' => 'Patron', 'email' => 'patron@harpysocial.com', 'password' => 'Patron123'],
            ['name' => 'Garson', 'email' => 'garson@harpysocial.com', 'password' => 'Garson123'],
        ];

        foreach ($users as $user) {
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
