<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Manual Seeding

        Category::create([
            'name' => "Web Programming",
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => "Tech News",
            'slug' => 'tech-news'
        ]);

        Category::create([
            'name' => "Sport News",
            'slug' => 'sport-news'
        ]);

        User::factory(5)->create();
        // Category::factory(4)->create();
        Post::factory(8)->create();
    }
}
