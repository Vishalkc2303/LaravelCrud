<?php

namespace App\Http\Controllers;

use App\Models\Sub_category;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getSubcategories($categoryId)
    {
        $subcategories = Sub_category::where('category_id', $categoryId)->get();
        // dd($subcategories);
        return response()->json(['subcategories' => $subcategories]);
    }
}
