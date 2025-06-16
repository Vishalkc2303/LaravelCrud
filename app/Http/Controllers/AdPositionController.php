<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdPositionController extends Controller
{
    //
    public function allPosition()
    {
        return view('admin.advertisement.allPosition');
    }
}
