<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    //
    public function AllNews()
    {
        // Retrieve news where status is 0 or 1
        $news = News::whereIn('status', [0, 1])->get();
        return view('admin.news.AllNews', compact('news'));
    }

    public function updateStatus(Request $request, $id)
    {
        $newsItem = News::findOrFail($id);
        $newsItem->status = $request->status;
        $newsItem->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
    public function deleteNews($id)
    {

        try {
            $news = News::findOrFail($id);
            $news->status = 2; // Update status to "Draft"
            $news->save();

            return redirect()->back()->with('success', 'News article status updated to Draft successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update news article status to Draft');
        }
    }

    public function AddNews()
    {
        $categories = Category::all();
        return view('admin.news.AddNews', compact('categories'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'subcategory_id' => 'required|integer|exists:sub_categories,id',
            'tags' => 'nullable|string'
        ]);

        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        // Create the news article
        $article = new News;
        $article->title = $request->input('title');
        $article->slug = Str::slug($request->input('title'), '-');
        $article->image = $imagePath;
        $article->content = $request->input('content');
        $article->meta_title = $request->input('meta_title');
        $article->meta_description = $request->input('meta_description');
        $article->user_id = Auth::id();
        $article->category_id = $request->input('category_id');
        $article->subcategory_id = $request->input('subcategory_id');
        $article->tags = $request->input('tags');
        $article->status = 0; // Default status
        $article->views = 0; // Default view count
        $article->save();

        // return redirect()->back()->with('success', 'News article created successfully.');
        return redirect()->route('AllNews')->with('success', 'News article created successfully.');
    }
    public function EditNews($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::all();

        return view('admin.news.editNews', compact('news', 'categories'));
    }
    public function updatenews(Request $request, News $news)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'tags' => 'nullable|string',
        ]);

        // Handle file upload if there's a new image
        if ($request->hasFile('image')) {
            // Store the image
            $imagePath = $request->file('image')->store('news', 'public');

            // Delete the old image if exists
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            // Set the new image path
            $news->image = $imagePath;
        }

        // Update the news article
        $news->title = $request->title;
        $news->content = $request->content;
        $news->meta_title = $request->meta_title;
        $news->meta_description = $request->meta_description;
        $news->category_id = $request->category_id;
        $news->subcategory_id = $request->subcategory_id;

        // Update tags if present in the request
        if ($request->filled('tags')) {
            $news->tags = $request->tags;
        }

        $news->save();

        // Redirect with a success message
        return redirect()->route('AllNews', $news)->with('success', 'News article updated successfully.');
    }
    public function DraftNews()
    {
        $news = News::where('status', 2)->get();

        return view('admin.news.draftnews', compact('news'));
    }
    public function permanentlydestroy(News $news)
    {
        // Delete the image associated with the news article
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        // Permanently delete the news article
        $news->delete();

        // Redirect back with a success message
        return redirect()->route('DraftNews')->with('success', 'News article Permanently deleted successfully.');
    }
    public function showNews($slug)
    {
        // Fetch news based on the provided slug
        $news = News::where('slug', $slug)->firstOrFail();
        $newsItems = News::where('status', 1)->inRandomOrder()->take(4)->get();

        // Fetch comments related to this news item
        $comments = $news->comments()->where('status', 0)->get();
        // dd($comments); // Assuming you have a 'status' column to filter approved comments

        // You can optionally eager load relationships here if needed
        // Example: $news->load('category', 'author');

        // Pass $news and $comments data to a view
        return view('newsDetail', compact('news', 'newsItems', 'comments'));
    }
}
