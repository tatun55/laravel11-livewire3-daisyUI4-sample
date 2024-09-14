<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザーを作成
        User::create([
            'name' => 'John Doe',
            'email' => 'test1@test.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'Jane Doe',
            'email' => 'test2@test.com',
            'password' => bcrypt('password'),
        ]);
    }
}
