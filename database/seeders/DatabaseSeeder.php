<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        //Post::factory(30)->create();

        User::factory(15)->create()->each(function($user){
            Post::factory(random_int(2,5))->random()->create(['user_id' => $user])->each(function($post){
                comment::factory(random_int(1,5))->create(['post_id' => $post]);
            });
        });
    }
}
