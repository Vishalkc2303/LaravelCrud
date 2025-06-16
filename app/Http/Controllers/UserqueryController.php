<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userquery;

class UserqueryController extends Controller
{
    public function userquery()
    {
        $userQuery = Userquery::all();
        return view('admin.User.userquery', compact('userQuery'));
    }
    public function updateUserQueryStatus(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|integer|in:0,1,2', // Adjust validation rules as needed
        ]);

        // Find the user query by ID
        $userQuery = UserQuery::findOrFail($id);

        // Update the user query's status
        $userQuery->status = $request->input('status');
        $userQuery->save();

        // Optionally, add a flash message or other response
        return redirect()->back()->with('success', 'User query status updated successfully!');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Userquery::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_no' => $request->input('phone'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
