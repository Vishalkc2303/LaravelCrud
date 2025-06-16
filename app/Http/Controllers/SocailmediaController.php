<?php

namespace App\Http\Controllers;

use App\Models\Socailmedia;
use Illuminate\Http\Request;

class SocailmediaController extends Controller
{
    public function socialmedia()
    {
        // Fetch current social media links or create a new instance with default values
        $socialMedia = Socailmedia::first();

        return view('admin.setting.socailmedia', compact('socialMedia'));
    }


    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        // Fetch the first social media links record
        $socialMedia = Socailmedia::first();

        if ($socialMedia) {
            // Update the existing record
            $socialMedia->update([
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'instagram' => $request->input('instagram'),
                'linkedin' => $request->input('linkedin'),
            ]);
        } else {
            // Create a new record if none exists
            Socailmedia::create([
                'facebook' => $request->input('facebook'),
                'twitter' => $request->input('twitter'),
                'instagram' => $request->input('instagram'),
                'linkedin' => $request->input('linkedin'),
            ]);
        }

        return redirect()->back()->with('success', 'Social media links updated successfully!');
    }
}
