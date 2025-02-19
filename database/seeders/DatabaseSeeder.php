<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // roles
        // users
        // posts

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
        $category = Category::factory(30)->create();
        $user = User::factory(10)->create();
        $post = Post::factory(100)->recycle($user)->recycle($category)->create();
        Comment::factory(100)->recycle($post)->recycle($user)->create();
    }
}
