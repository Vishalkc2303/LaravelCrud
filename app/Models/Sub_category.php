<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';

    // Define the fillable fields
    protected $fillable = ['name', 'category_id'];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Optionally, you can define the relationship with the Blog model if needed
    // public function blogs()
    // {
    //     return $this->hasMany(Blog::class, 'subcategory_id');
    // }
}
