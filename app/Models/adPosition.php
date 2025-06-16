<?php

namespace App\Models;

use App\Http\Controllers\AdvertisementController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adPosition extends Model
{
    use HasFactory;
    public function advertisementSpaces()
    {
        return $this->hasMany(Advertisement::class, 'position');
    }
}
