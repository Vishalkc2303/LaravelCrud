<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\News;
use App\Models\Sub_category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function addcategory()
    {
        $categories = category::all();
        $subcategories = Sub_category::all();
        return view('admin.category.addcategory', compact('categories', 'subcategories'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        // Create a new category
        category::create([
            'name' => $request->category,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category added successfully.');
    }
    public function updatecategory(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Update the category's name
        $category->name = $request->input('category_name');
        $category->save();

        // Redirect back with a success message
        return redirect()->route('addcategory')->with('success', 'Category updated successfully.');
    }
    public function storesubcategory(Request $request)
    {
        // Validate the request data
        $request->validate([
            'existing_category' => 'required|exists:categories,id',
            'subcategory' => 'required|string|max:255',
        ]);

        // Create a new subcategory
        sub_category::create([
            'category_id' => $request->existing_category,
            'name' => $request->subcategory,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Subcategory added successfully.');
    }
    public function subcategoryupdate(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_name' => 'required|string|max:255',
        ]);

        // Find the subcategory by ID
        $subcategory = Sub_category::findOrFail($id);

        // Update the subcategory's details
        $subcategory->category_id = $request->input('category_id');
        $subcategory->name = $request->input('subcategory_name');
        $subcategory->save();

        // Redirect back with a success message
        return redirect()->route('addcategory')->with('success', 'Subcategory updated successfully.');
    }
    public function categoryNews($id,$name)
    {
        $categorynews = News::where('category_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 items per page
        // dd($news);
        return view('categoryNews', compact('categorynews', 'name'));
    }
    public function subcategoryNews($id, $name)
    {
        $categorynews = News::where('subcategory_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 items per page

        return view('categoryNews', compact('categorynews', 'name'));
    }
}
