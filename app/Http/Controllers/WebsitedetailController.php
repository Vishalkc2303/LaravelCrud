<?php

namespace App\Http\Controllers;

use App\Models\Websitedetail;
use Illuminate\Http\Request;

class WebsitedetailController extends Controller
{
    //
    public function websitedetail()
    {
        $settings = Websitedetail::first();
        return view('admin.setting.websitedetail', compact('settings'));
    }
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'website_name' => 'nullable|string|max:255',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'website_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'nullable|email|max:255',
            'phone_no' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
            'terms_year' => 'nullable|integer|min:1900|max:' . date('Y'),
        ]);

        // Update or create the website details
        $websitedetail = Websitedetail::first();
        if (!$websitedetail) {
            $websitedetail = new Websitedetail();
        }

        // Handle file uploads
        // $website_logo = null;
        if ($request->hasFile('website_logo')) {
            $website_logo = $request->file('website_logo')->store('logos','public');
            $websitedetail->logo = $website_logo ?? $websitedetail->website_logo;
        }

        // $website_favicon = null;
        if ($request->hasFile('website_favicon')) {
            $website_favicon = $request->file('website_favicon')->store('favicons','public');
            $websitedetail->favicon = $website_favicon ?? $websitedetail->website_favicon;
        }



        $websitedetail->website_name = $request->input('website_name', $websitedetail->website_name);

        $websitedetail->email = $request->input('email', $websitedetail->email);
        $websitedetail->phone_no = $request->input('phone_no', $websitedetail->phone_no);
        $websitedetail->location = $request->input('location', $websitedetail->location);
        $websitedetail->year = $request->input('terms_year', $websitedetail->terms_year);

        $websitedetail->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
