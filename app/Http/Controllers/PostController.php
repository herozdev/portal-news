<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post) {
        return view('post', [
            'title' => "Detail Post",
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }
}