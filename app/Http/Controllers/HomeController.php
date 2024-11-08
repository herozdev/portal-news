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
            'post' => Post::latest()->paginate(8)->withQueryString(),
            'slide' => Post::latest()->take(4)->get(),
            'categories' => Category::all(),
        ]);
    }

    public function archive()
    {
        return view('archive', [
            'title' => 'Archive -> ' . request('search') ,
            'categories' => Category::all(),
            'post' => Post::latest()->filter(request(['search']))->get(),
        ]);
    }
}
