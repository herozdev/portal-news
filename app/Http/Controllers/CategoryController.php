<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return view('category', [
            'title' => $category->name,
            'post' => $category->post->load('category', 'user'),
            'category' => $category->name,
            'categories' => Category::all(),
        ]);
    }
}
