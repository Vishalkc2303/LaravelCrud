<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Newsbookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NewsbookmarkController extends Controller
{
    //
    public function add($id)
    {
        $news = News::findOrFail($id);

        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the bookmark already exists
            $existingBookmark = Newsbookmark::where('user_id', $user->id)->where('news_id', $news->id)->first();
            if ($existingBookmark) {
                return redirect()->back()->with('message', 'You have already bookmarked this news item.');
            }

            // Create a new bookmark
            $bookmark = new Newsbookmark();
            $bookmark->user_id = $user->id;
            $bookmark->news_id = $news->id;
            $bookmark->save();

            return redirect()->back()->with('message', 'News item bookmarked successfully.');
        } else {
            return redirect()->route('login')->with('message', 'You need to login to bookmark news items.');
        }
    }
    public function remove(Request $request, $id)
    {
        $news = News::findOrFail($id);

        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Find the existing bookmark
            $bookmark = Newsbookmark::where('user_id', $user->id)->where('news_id', $news->id)->first();
            if ($bookmark) {
                $bookmark->delete();
                return redirect()->back()->with('message', 'Bookmark removed successfully.');
            }

            return redirect()->back()->with('message', 'Bookmark not found.');
        } else {
            return redirect()->route('login')->with('message', 'You need to login to remove bookmarks.');
        }
    }
}
