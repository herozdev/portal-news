<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['category', 'user'];

    public function scopeFilter($query, array $filters)
    {
        // $query->when($filters['search'] ?? false, function($query, $search) {
        //     return $query->where('title', 'like', '%' . $search . '%')
        //             ->orWhere('body' , 'like', '%' . $search . '%');
        // });

        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     return $query->whereHas('category', function ($query) use ($search) {
        //         $query->where('name', 'like', '%' . $search . '%')
        //             ->orWhere('title', 'like', '%' . $search . '%')
        //             ->orWhere('body', 'like', '%' . $search . '%');
        //     });
        // });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->join('categories', 'posts.category_id', '=', 'categories.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('categories.name as category_name', 'users.name as user_name', 'posts.*')
                ->where(function ($query) use ($search) {
                    $query->whereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('title', 'like', '%' . $search . '%')
                            ->orWhere('body', 'like', '%' . $search . '%');
                    })
                        ->orWhereHas('user', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        });
                })
                ->orderBy('posts.created_at', 'desc');
        });

        // dd($query->toSql(), $query->getBindings(), $filters['search']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
