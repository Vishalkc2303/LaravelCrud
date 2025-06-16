<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Newslikedislike;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NewslikedislikeController extends Controller
{
    public function add($id)
    {
        $news = News::findOrFail($id);
        $userId = Auth::id();

        // Check if the like already exists
        $exists = Newslikedislike::where('user_id', $userId)
            ->where('news_id', $news->id)
            ->exists();

        if (!$exists) {
            $like = new Newslikedislike();
            $like->user_id = $userId;
            $like->news_id = $news->id;
            $like->save();
        }
        $news->increment('likeCount');
        return redirect()->back()->with('success', 'News item liked successfully.');
    }

    public function remove($id)
    {
        $news = News::findOrFail($id);
        $userId = Auth::id();

        // Check if the like exists
        $exists = Newslikedislike::where('user_id', $userId)
            ->where('news_id', $news->id)
            ->exists();

        if ($exists) {
            Newslikedislike::where('user_id', $userId)
                ->where('news_id', $news->id)
                ->delete();
        }
        if ($news->likeCount > 0) {
            $news->decrement('likeCount');
        }
        return redirect()->back()->with('success', 'Like removed successfully.');
    }
}
