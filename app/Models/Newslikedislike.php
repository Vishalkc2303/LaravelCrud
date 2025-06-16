<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newslikedislike extends Model
{
    use HasFactory;
    protected $table = 'newslikedislikes';

    // Define the fillable fields
    protected $fillable = ['news_id', 'user_id', 'like', 'dislike'];

    // Define the relationship with the News model
    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
