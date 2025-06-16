<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserHistory;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    // public function viewNews($id)
    // {
    //     // dd($id);
    //     $news = News::findOrFail($id);

    //     // Record user history
    //     $userHistory = new UserHistory();
    //     $userHistory->user_id = Auth::id();
    //     $userHistory->news_id = $news->id;
    //     $userHistory->save();
    //     // $news->increment('views');
    //     return redirect()->route('news.show', $news->slug);
    //     // return view('news.show', compact('news'));
    //     // return redirect()->back()->with('success', 'News item liked successfully.');


    //     // Other logic for displaying the news article
    // }

    public function viewNews($id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['error' => 'News not found'], 404);
        }

        $userId = Auth::id();

        // Check if user history already exists
        $existingHistory = UserHistory::where('user_id', $userId)
            ->where('news_id', $news->id)
            ->first();

        // Delete previous history if it exists
        if ($existingHistory) {
            $existingHistory->delete();
        }

        // Record new user history
        $userHistory = new UserHistory();
        $userHistory->user_id = $userId;
        $userHistory->news_id = $news->id;
        $userHistory->save();

        // Increment view count
        $news->increment('views');

        return response()->json(['success' => 'History saved successfully']);
    }
    public function remove($id)
    {
        // Find the history record by its ID
        $history = UserHistory::findOrFail($id);

        // Perform deletion
        $history->delete();

        // Redirect back or to a specific route
        return redirect()->back()->with('success', 'History entry deleted successfully.');
    }
    public function removeAllHistory()
    {
        $user = Auth::user();

        // Delete all history entries for the authenticated user
        UserHistory::where('user_id', $user->id)->delete();

        return redirect()->route('home')->with('success', 'All history entries deleted successfully.');
    }



    // public function viewNews($id)
    // {
    //     $news = News::find($id);

    //     if (!$news) {
    //         return response()->json(['error' => 'News not found'], 404);
    //     }

    //     // Record user history
    //     $userHistory = new UserHistory();
    //     $userHistory->user_id = Auth::id();
    //     $userHistory->news_id = $news->id;
    //     $userHistory->save();

    //     // Increment view count
    //     $news->increment('views');

    //     return response()->json(['success' => 'History saved successfully']);
    // }
}
