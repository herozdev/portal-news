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
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('file');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('uploads');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $this->resizeImage($image->getRealPath(), $destinationPath . '/' . $imageName, 800);

        return response()->json(url('uploads/' . $imageName));
    }


    public function storePost(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts'],
            'category_id' => ['required'],
            'body' => ['required', 'min:20', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads');

            // Buat folder jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Resize gambar
            $resizedImagePath = $destinationPath . '/' . $imageName;
            $this->resizeImage($image->getRealPath(), $resizedImagePath, 800);

            $data['image'] = 'uploads/' . $imageName;
        }

        $data['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::create($data);

        return redirect('/dashboard/posts')->with('success', 'New post published !!');
    }

    private function resizeImage($sourcePath, $destinationPath, $newWidth)
    {
        list($width, $height) = getimagesize($sourcePath);
        $newHeight = intval($height * $newWidth / $width);

        $imageResized = imagecreatetruecolor($newWidth, $newHeight);
        $imageOriginal = imagecreatefromstring(file_get_contents($sourcePath));

        imagecopyresampled(
            $imageResized,
            $imageOriginal,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $width,
            $height
        );

        imagejpeg($imageResized, $destinationPath, 90);
        imagedestroy($imageResized);
        imagedestroy($imageOriginal);
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
        $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'category_id' => ['required'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
        ]);

        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'body' => $request->body,
        ];

        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $resizedImagePath = $destinationPath . '/' . $imageName;
            $this->resizeImage($image->getRealPath(), $resizedImagePath, 800);
            $data['image'] = 'uploads/' . $imageName;
        }

        // Proses gambar di Summernote
        $this->handleSummernoteImages($post->body, $request->body);

        if ($request->slug != $post->slug) {
            $data['slug'] = ['required', 'unique:posts'];
        }


        $data['user_id'] = auth()->user()->id;
        $data['excerpt'] = Str::limit(strip_tags($request->body), 100);

        Post::where('id', $post->id)->update($data);

        return redirect('/dashboard/posts')->with('success', 'Your post has been updated !!');
    }

    private function handleSummernoteImages($oldContent, $newContent)
    {
        $oldImages = $this->extractImagePaths($oldContent);
        $newImages = $this->extractImagePaths($newContent);

        // Gambar yang harus dihapus (tidak ada di konten baru)
        $imagesToDelete = array_diff($oldImages, $newImages);
        foreach ($imagesToDelete as $image) {
            if (file_exists(public_path($image))) {
                unlink(public_path($image));
            }
        }
    }

    private function extractImagePaths($content)
    {
        $paths = [];

        // Cek apakah konten kosong
        if (empty(trim($content))) {
            return $paths;
        }

        // Aktifkan error suppression untuk DOMDocument
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();

        // Pastikan encoding benar
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');

        // Load HTML ke DOMDocument
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        libxml_clear_errors();

        // Ambil semua tag <img>
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            if ($img->hasAttribute('src')) {
                $src = $img->getAttribute('src');

                // Pastikan hanya gambar lokal yang diproses
                if (strpos($src, url('/')) !== false) {
                    $src = str_replace(url('/'), '', $src);
                }

                $paths[] = $src;
            }
        }

        return $paths;
    }
}
