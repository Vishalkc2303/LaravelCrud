<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\News;
use App\Models\Comment;
use App\Models\Newsbookmark;
use App\Models\UserHistory;
use App\Models\Userquery;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $newsItems = News::where('status', 1)->inRandomOrder()->take(4)->get();
        // $newsItems = News::where('status', 1)
        //     ->orderBy('created_at', 'desc')
        //     ->take(4)
        //     ->get();

        return view('home', compact('newsItems'));
    }

    public function admin()
    {
        return view('admin.index');
    }
    public function term()
    {
        return view('term');
    }
    public function contact()
    {
        return view('contact');
    }
    public function profilepage()
    {
        return view('user.profile');
    }
    public function bookmarkPost()
    {
        $bookmarks = Newsbookmark::where('user_id', Auth::id())->get();
        return view('user.bookmark', compact('bookmarks'));
    }
    public function commentPost()
    {
        $comments = Comment::where('userid', Auth::id())->get();

        return view('user.comment', compact('comments'));
    }
    public function historyPost()
    {
        $historys = UserHistory::where('user_id', Auth::id())->get();

        return view('user.history', compact('historys'));
    }
    public function updatePasswordpage()
    {
        return view('user.updatepassword');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $search = News::where('title', 'like', '%' . $query . '%')
            ->orWhere('meta_description', 'like', '%' . $query . '%')
            ->orWhere('meta_title', 'like', '%' . $query . '%')
            ->orWhere('slug', 'like', '%' . $query . '%')
            ->orWhere('tags', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('searchData', compact('search', 'query'));
    }
    public function alluser()
    {
        if (auth()->user()->role === 'admin') {
            // Retrieve all users
            $Users = User::all();
        } else {
            // Retrieve only users with the role 'user'
            $Users = User::where('role', 'user')->get();
        }
        // Return the view with the retrieved users
        return view('admin.User.alluser', compact('Users'));
    }

    public function updateUserStatus(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|integer|in:0,1', // Adjust validation rules as needed
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's status
        $user->status = $request->input('status');
        $user->save();

        // Optionally, add a flash message or other response
        return redirect()->back()->with('success', 'User status updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        // Validate the form data

        // dd($request);
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The current password is incorrect.'])->withInput();
        }

        // Update the user's password
        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        // Flash a success message to the session
        session()->flash('success', 'Your password has been successfully updated.');

        return redirect()->back();
    }

    public function updateUserProfile(Request $request)
    {
        // Validate the form data
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update the user's details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Flash a success message to the session
        session()->flash('success', 'Your profile has been successfully updated.');

        return redirect()->back();
    }
}
