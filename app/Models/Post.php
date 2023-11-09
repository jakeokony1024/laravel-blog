<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            ));

        $query->when($filters['category'] ?? false, fn ($query, $category) =>
//            $query
//                ->whereExists(fn($query) =>
//                    $query->from('categories')
//                        ->whereColumn('categories.id', 'posts.category_id')
//                        ->where('categories.slug', $category))
            $query->whereHas('category', fn ($query) => $query->where('slug', $category))
        );

        $query->when($filters['author'] ?? false, fn ($query, $author) =>
//            $query
//                ->whereExists(fn($query) =>
//                    $query->from('categories')
//                        ->whereColumn('categories.id', 'posts.category_id')
//                        ->where('categories.slug', $category))
        $query->whereHas('author', fn ($query) => $query->where('user', $author))
        );
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
