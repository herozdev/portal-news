<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Home',
            'post' => Post::with(['user', 'category'])->latest()->get(),
            'categories' => Category::all(),
        ]);
    }

    public function archive()
    {
        return view('archive', [
            'title' => 'Archive',
        ]);
    }
}
