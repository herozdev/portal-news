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

        // Category::create([
        //     'name' => "Pemrograman",
        //     'slug' => 'pemrograman'
        // ]);

        // Category::create([
        //     'name' => "Teknologi",
        //     'slug' => 'teknologi'
        // ]);

        // Category::create([
        //     'name' => "Otomotif",
        //     'slug' => 'otomotif'
        // ]);

        User::factory(5)->create();
        Category::factory(4)->create();
        Post::factory(10)->create();
    }
}
