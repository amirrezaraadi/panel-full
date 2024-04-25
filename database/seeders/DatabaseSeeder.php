<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Manager\Article;
use App\Models\Manager\Category;
use App\Models\Manager\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(15)->create();
        Tag::factory(10)->create();
        Category::factory(10)->create();
//         Article::factory(10)->create();
//        $this->call([
//            UserSeeder::class
//        ]);
    }
}
