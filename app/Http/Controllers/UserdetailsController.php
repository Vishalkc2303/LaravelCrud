<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserdetailsController extends Controller
{
    public function updateUserDetails(Request $request)
    {
        // Validate the form data
        $request->validate([
            'bio' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for profile image
        ]);

        // Get the authenticated user
        $user = Auth::user();

        if ($request->hasFile('profile')) {
            // Delete old profile image if exists
            if ($user->userDetail && $user->userDetail->profile) {
                Storage::disk('public')->delete($user->userDetail->profile);
            }
            $profilePath = $request->file('profile')->store('profiles', 'public');
        }

        // Update the user's details
        $user->userDetail()->updateOrCreate([], [
            'bio' => $request->bio,
            'website' => $request->website,
            'location' => $request->location,
            'profile' => $profilePath ?? $user->userDetail->profile ?? null,
        ]);

        // Flash a success message to the session
        session()->flash('success', 'Your profile has been successfully updated.');

        return redirect()->back();
    }
}
