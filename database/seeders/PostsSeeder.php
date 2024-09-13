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

        for ($i = 1; $i <= $totalPosts; $i++) {
            $currentTimestamp = (clone $now)->subDays($totalPosts - $i);
            $posts[] = [
                'message' => "Post #$i",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
