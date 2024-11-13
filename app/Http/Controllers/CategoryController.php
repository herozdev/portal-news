<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->post()->with('category','user')->paginate(4)->withQueryString();
        return view('category', [
            'title' => $category->name,
            'post' => $posts,
            // 'post' => $category->post->load('category', 'user')->paginate(8)->withQueryString(),
            'category' => $category->name,
            'categories' => Category::all(),
        ]);
    }
}
