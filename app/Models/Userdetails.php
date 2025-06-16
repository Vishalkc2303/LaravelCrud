<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userdetails extends Model
{
    use HasFactory;
    protected $table = 'userdetails';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'full_name',
        'profile',
        'avatar_url',
        'bio',
        'website',
        'location'
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
