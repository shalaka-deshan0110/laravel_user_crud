<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostsController extends Controller
{
    /**
     *  Get posts from fake api
     */
    public function index()
    {
        $posts = Http::get('https://jsonplaceholder.typicode.com/posts');

        return view('posts.index',[
            "posts" => json_decode($posts)
        ]);
    }

    public function show($id)
    {

        $response = Http::get('https://jsonplaceholder.typicode.com/posts/'.$id);

        return json_decode($response->body());

        // return view('posts.show',[
        //     "post" => json_decode($response->body())
        // ]);
    }

}
