<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function userリレーションを返す(): void
    {
       $post = Post::factory()->create();

       $this->assertInstanceOf(User::class,$post->user);
    }

    /** @test */
    public function commentsリレーションのテスト(){

        $post = Post::factory()->create();
        $this->assertInstanceOf(Collection::class,$post->comments);
    }
}
