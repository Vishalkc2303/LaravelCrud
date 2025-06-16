<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\adPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdvertisementController extends Controller
{
    public function advertisement()
    {
        return view('admin.advertisement.addadvertisement');
    }
    public function storeadd(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'links' => 'nullable|url',
            'script' => 'nullable|string',
            'position' => 'required|integer',
            'status' => 'required|integer',
        ]);

        // Create a new ad space
        $adSpace = new Advertisement();
        $adSpace->name = $validated['name'];
        $adSpace->type = $validated['type'];
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ads', 'public');
            $adSpace->image = $imagePath;
        }
        $adSpace->links = $validated['links'];
        $adSpace->script = $validated['script'];
        $adSpace->position_id = $validated['position'];
        $adSpace->status = $validated['status'];
        $adSpace->save();

        return redirect()->back()->with('status', 'Advertisement space created successfully!');
    }

    public function adadvertisement(Request $req)
    {
        // dd($req);    
        // Validate the request based on the advertisement type
        if ($req->type == "2") {
            $validator = Validator::make($req->all(), [
                'name' => 'required',
                'type' => 'required',
                'script' => 'required',
                'position' => 'required'
            ]);
        } elseif ($req->type == "1") {
            $validator = Validator::make($req->all(), [
                'name' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maximum file size of 2MB
                'links' => 'required',
                'position' => 'required'
            ]);
        }
        // dd($validator);
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // If validation passes, create and save the advertisement space
        $advspace = new Advertisement;
        $advspace->name = $req->name;
        $advspace->type = $req->type;
        $advspace->script = $req->script;
        $advspace->position = $req->position;

        // Handle image upload
        if ($req->hasFile('image')) {
            // $imagePath = $request->file('image')->store('news', 'public');

            $imagePath = $req->file('image')->store('ads', 'public');
            $advspace->image = $imagePath;
        }

        $advspace->links = $req->links;
        $advspace->status = $req->status;
        $advspace->save();

        return back()->with('status', 'You have successfully added the ad.');
    }
    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'status' => 'required|integer|in:0,1,2',
        ]);

        // Find the advertisement by id
        $ad = Advertisement::findOrFail($id);

        // Check if the new status is active (status = 1)
        if ($validated['status'] == 1) {
            // Check if there are any other active advertisements on the same position
            $existingActiveAd = Advertisement::where('position', $ad->position)
                ->where('status', 1)
                ->where('id', '!=', $id) // Exclude the current advertisement being updated
                ->first();

            if ($existingActiveAd) {
                return redirect()->back()->with('error', 'Another advertisement is already active on this position.');
            }
        }

        // Update the advertisement status
        $ad->status = $validated['status'];
        $ad->save();

        return redirect()->back()->with('status', 'Advertisement status updated successfully!');
    }


    public function edit($id)
    {
        $ad = Advertisement::findOrFail($id);
        $positions = adPosition::pluck('name', 'id');
        return view('admin.advertisement.editadvertisement', compact('ad', 'positions'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        // Validate the request based on advertisement type
        if ($request->type == "2") {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|integer',
                'script' => 'required|string',
                'position' => 'required|integer',
                'status' => 'required|integer',
            ]);
        } elseif ($request->type == "1") {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maximum file size of 2MB
                'links' => 'required|url',
                'position' => 'required|integer',
                'status' => 'required|integer',
            ]);
        }

        // Check if validation fails
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find the advertisement by id
        $ad = Advertisement::findOrFail($id);

        // Check if there are any other active advertisements on the new position
        if ($request->status == 1) {
            $existingActiveAd = Advertisement::where('position', $request->position)
                ->where('status', 1)
                ->first();

            if ($existingActiveAd) {
                return back()->withInput()->withErrors(['status' => 'Another advertisement is already active on this position.']);
            }
        }

        // Update the advertisement data
        $ad->name = $request->name;
        $ad->type = $request->type;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ads', 'public');
            $ad->image = $imagePath;
        }
        $ad->links = $request->links;
        $ad->script = $request->script;
        $ad->position = $request->position;
        $ad->status = $request->status;
        $ad->save();

        return redirect()->route('advertisement')->with('status', 'Advertisement updated successfully!');
    }
}
