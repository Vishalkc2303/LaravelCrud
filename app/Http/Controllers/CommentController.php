<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'newid' => 'required|integer|exists:news,id',
            'comment' => 'required|string|max:5000',
        ]);

        Comment::create([
            'newid' => $request->input('newid'),
            'userid' => Auth::id(),
            'comment' => $request->input('comment'),
            'status' => '0', // Or any other default status
        ]);

        return redirect()->back()->with('success', 'Comment posted successfully!');
    }
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        // Ensure the user owns the comment
        // if ($comment->user_id !== auth()->id()) {
        //     abort(403, 'Unauthorized action.');
        // }

        $comment->delete();

        return redirect()->route('commentPost')->with('success', 'Comment deleted successfully.');
    }
}
