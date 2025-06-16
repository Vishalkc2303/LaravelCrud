<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    public function addposition()
    {
        return $this->belongsTo(adPosition::class, 'position');
    }
}
