<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function auth()
    {
        return view('login', [
            'title' => "Login User",
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function registration()
    {
        return view('register', [
            'title' => "Registration User",
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:5', 'max:50', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:15']
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/auth')->with('success', 'Registration Successfull!!');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Username and Password not found!!');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'title' => "Dashboard"
        ]);
    }

    public function indexPosts()
    {
        return view('admin.posts.posts', [
            'title' => "My Posts",
            'post' => Post::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function indexCategories()
    {
        return view('admin.categories.categories', [
            'title' => "List Categories",
            'categories' => Category::all(),
        ]);
    }

    public function showPosts(Post $post)
    {
        return view('admin.posts.detailPost', [
            'title' => "Detail Post : " . $post->title,
            'post' => $post,
        ]);
    }

    public function createPosts()
    {
        return view('admin.posts.createPost', [
            'title' => "Create Post",
            'categories' => Category::all(),
        ]);
    }

    public function createCategories()
    {
        return view('admin.categories.create', [
            'title' => "Create Category",
            'categories' => Category::all(),
        ]);
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    public function checkSLugCategory(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img-content', $imageName);
            // return asset('storage/img-content/' . $imageName);

            return response()->json(['url' => 'storage/img-content/' . $imageName]);
        }
    }

    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts'],
            'category_id' => ['required'],
            'body' => ['required', 'min:20', 'max:100000'],
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/img-content', $imageName);
            $validated['image'] = $imageName;
        }

        $validated['user_id'] = auth()->user()->id;
        $validated['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::create($validated);

        return redirect('/dashboard/posts')->with('success', 'New post published !!');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'slug' => ['required', 'unique:categories'],
        ]);

        Category::create($validated);

        return redirect('/dashboard/categories')->with('success', 'New category created !!');
    }

    public function deletePost(Post $post)
    {
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Your post has been deleted !!');
    }

    public function editPost(Post $post)
    {
        return view('admin.posts.editPost', [
            'title' => "Edit Post",
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    public function updatePost(Request $request, Post $post)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'category_id' => ['required'],
            'body' => ['required'],
        ];

        if ($request->slug != $post->slug) {
            $rules['slug'] = ['required', 'unique:posts'];
        }

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::where('id', $post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Your post has been updated !!');
    }
}
