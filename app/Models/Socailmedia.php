<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socailmedia extends Model
{
    use HasFactory;
    protected $table = 'socialmedia';
    protected $fillable = ['facebook', 'twitter', 'instagram', 'linkedin'];
}
