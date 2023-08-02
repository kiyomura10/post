<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class PostListControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

     /** @test */
    public function Topページでブログ一覧が表示される(): void
    {
        $post1 = Post::factory()->hasComments(3)->create(['title' => 'ブログのタイトル１']);
        $post2 = Post::factory()->hasComments(5)->create(['title' => 'ブログのタイトル２']);
        Post::factory()->hasComments(1)->create();

        $response = $this->get('/');
        $response->assertOK();
        $response->assertSee('ブログのタイトル１');
        $response->assertSee('ブログのタイトル２');
        $response->assertSee($post1->user->name);
        $response->assertSee($post2->user->name);
        $response->assertSee('(3件のコメント)');
        $response->assertSee('(5件のコメント)');
        $response->assertSeeInOrder([
            '(5件のコメント)',
            '(3件のコメント)',
            '(1件のコメント)',
        ]);
  
    }

    /** @test */
    function ブログの一覧で、非公開のブログは表示されない()
    {
        $post = Post::factory()->closed()->create([
            'title' => 'これは非公開のブログです',
        ]);

        $post2 = Post::factory()->create([
            'title' => 'これは公開済みのブログです',
        ]);

        $this->get('/')
            ->assertDontSee('これは非公開のブログです')
            ->assertSee('これは公開済みのブログです');
    }

    /** @test */ 
    public function factoryの観察(){
       $post = Post::factory()->create();
       dump($post->toArray());

       dump(User::get()->toArray());
        $this->assertTrue(true);
    }

    /** @test */
    public function ブログの公開・非公開のscope()
    {
        $post1 = Post::factory()->closed()->create();

        $post2 = Post::factory()->create();

        $posts = Post::onlyOpen()->get();

        $this->assertFalse($posts->contains($post1));
        $this->assertTrue($posts->contains($post2));
    }
}
