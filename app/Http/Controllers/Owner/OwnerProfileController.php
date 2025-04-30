<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OwnerProfileController extends Controller
{
    public function index()
    {
        return view('owner.profile');
    }

    public function profile_submit(Request $request)
    {
        $owner_data = Owner::where('email', Auth::guard('owner')->user()->email)->first();
    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:owners,email,' . $owner_data->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
    
        // Handling password update
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|min:6',
                'retype_password' => 'required|same:password'
            ]);
            $owner_data->password = Hash::make($request->password);
        }
    
        // Handling image upload
        if ($request->hasFile('image')) { // <-- Use 'image' instead of 'photo'
            // Delete old image if it exists
            if ($owner_data->image && File::exists(public_path('uploads/' . $owner_data->image))) {
                File::delete(public_path('uploads/' . $owner_data->image));
            }
    
            // Generate a unique file name
            $uploaded_image = $request->file('image');
            $final_name = 'owner_' . time() . '.' . $uploaded_image->getClientOriginalExtension();
    
            // Move the file to the uploads directory
            $uploaded_image->move(public_path('uploads/'), $final_name);
    
            // Save the new image name in the database
            $owner_data->image = $final_name;
        }
    
        // Update name and email
        $owner_data->name = $request->name;
        $owner_data->email = $request->email;
        $owner_data->save();
    
        return redirect()->back()->with('success', 'Profile information is saved successfully.');
    }
    
}
