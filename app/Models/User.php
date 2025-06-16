<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    // Define the relationship with the BlogBookmark model
    public function blogBookmarks()
    {
        return $this->hasMany(BlogBookmark::class, 'user_id');
    }

    // Optionally, you can also define a relationship to get all bookmarked blogs by the user
    public function bookmarkedBlogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_bookmarks', 'user_id', 'blog_id');
    }
    public function reportBlogs()
    {
        return $this->hasMany(ReportBlog::class, 'user_id');
    }

    // Define the relationship with the News model
    public function news()
    {
        return $this->hasMany(News::class, 'user_id');
    }

    // Define the relationship with the NewsLikeDislike model
    public function newsLikeDislikes()
    {
        return $this->hasMany(NewsLikeDislike::class, 'user_id');
    }

     // Define the relationship with the NewsBookmark model
     public function newsBookmarks()
     {
         return $this->hasMany(NewsBookmark::class, 'user_id');
     }

     public function userDetail()
     {
         return $this->hasOne(Userdetails::class, 'user_id');
     }
 
}
