<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    // Assuming the table name is 'news'
    protected $table = 'news';

    // Define the fillable fields
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'meta_title',
        'meta_description',
        'user_id',
        'category_id',
        'subcategory_id',
        'tags',
        'status',
        'views'
    ];

    // Cast the 'tags' field to an array
    protected $casts = [
        'tags' => 'array',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }

    // Define the relationship with the SubCategory model
    public function subCategory()
    {
        return $this->belongsTo(Sub_category::class, 'subcategory_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(NewsBookmark::class, 'news_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'newid');
    }
    public function histories()
    {
        return $this->hasMany(UserHistory::class);
    }
}
