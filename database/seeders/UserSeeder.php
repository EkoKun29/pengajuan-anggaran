<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Super',
                'email' => 'adminsuper@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin super',
                'kode' => 'ADMS'
            ],
            [
                'name' => 'Direktur',
                'email' => 'direktur@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'direktur',
                'kode' => 'DIR'
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'kode' => 'ADM'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
//php artisan db:seed --class=UserSeeder