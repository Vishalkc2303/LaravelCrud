<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsbookmark extends Model
{
    use HasFactory;
    protected $table = 'newsbookmarks';

    // Define the fillable fields
    protected $fillable = ['user_id', 'news_id'];

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
