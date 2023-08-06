<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){

       // DB::enableQueryLog();

        $posts = Post::query()
        ->onlyOpen()
        ->orderByDesc('comments_count')
        ->withCount('comments')
        ->get();

       // $queries = DB::getQueryLog();
       // dd($queries);

        return view('index',compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show',compact('posts'));
    }
}
