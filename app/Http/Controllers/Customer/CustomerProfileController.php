<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Hash;
use Auth;

class CustomerProfileController extends Controller
{
    public function index()
    {
        return view('customer.profile');
    }

    public function profile_submit(Request $request)
    {
        $customer_data = Customer::where('email',Auth::guard('customer')->user()->email)->first();
        
//server side validation fo password and retype password
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',['nullable', 'string', 'min:6', 'regex:/[A-Za-z]/', 'regex:/[0-9]/', 'regex:/[^A-Za-z0-9]/'],
            'retype_password' => ['same:password'],
            'phone' => 'required|numeric',
            'country' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required|numeric',


        
        ]);

        if($request->password!='') {
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password'
            ]);
            $customer_data->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
    $request->validate([
        'photo' => 'image|mimes:jpg,jpeg,png,gif'
    ]);

    // Check if the old photo exists and is not a directory
    if (!empty($customer_data->photo) && file_exists(public_path('uploads/' . $customer_data->photo)) && !is_dir(public_path('uploads/' . $customer_data->photo))) {
        unlink(public_path('uploads/' . $customer_data->photo));
    }

    $ext = $request->file('photo')->extension();
    $final_name = time().'.'.$ext;
    $request->file('photo')->move(public_path('uploads/'), $final_name);

    $customer_data->photo = $final_name;
}


        
        $customer_data->name = $request->name;
        $customer_data->email = $request->email;
        $customer_data->phone = $request->phone;
        $customer_data->country = $request->country;
        $customer_data->address = $request->address;
        $customer_data->state = $request->state;
        $customer_data->city = $request->city;
        $customer_data->zip = $request->zip;
        $customer_data->update();

        return redirect()->back()->with('success', 'Profile information is saved successfully.');
    }
}
