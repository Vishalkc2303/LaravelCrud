<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportBlog extends Model
{
    use HasFactory;
    protected $table = 'report_blogs';

    // Define the fillable fields
    protected $fillable = ['user_id', 'blog_id', 'reason'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define the relationship with the Blog model
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
