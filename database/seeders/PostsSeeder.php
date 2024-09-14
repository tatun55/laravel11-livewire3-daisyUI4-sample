<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [];
        $totalPosts = 100;
        $now = now();

        // ユーザーに紐づく投稿を作成
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            for ($i = 1; $i <= $totalPosts; $i++) {
                $currentTimestamp = (clone $now)->subDays($totalPosts - $i);
                $posts[] = [
                    'user_id' => $user->id,
                    'message' => "Post #$i from $user->name",
                    'created_at' => $currentTimestamp,
                    'updated_at' => $currentTimestamp,
                ];
            }
        }

        DB::table('posts')->insert($posts);
    }
}
