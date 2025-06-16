<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * Get the news for the category.
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }
}
