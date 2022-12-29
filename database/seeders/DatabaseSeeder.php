<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Article::factory()->count(20)->create();
        Comment::factory()->count(40)->create();

        $list = ["General", "Mobile", "News", "Tech", "Language"];
        foreach ($list as $name) {
            Category::create([
                "name" => $name,
            ]);
        }

        User::factory()->create([
            "name" => "Alice",
            "email" => "alice@gmail.com",
        ]);

        User::factory()->create([
            "name" => "Bob",
            "email" => "bob@gmail.com",
        ]);
    }
}
