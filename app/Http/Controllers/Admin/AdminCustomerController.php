<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminCustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('admin.customer_view', compact('customers'));
    }

    public function create()
    {
        return view('admin.customer_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string',
            'country' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Handle Photo Upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension(); // Generates unique filename
                $file->move(public_path('uploads/customers'), $filename); // Moves to public/uploads/customers/
                $photoPath = $filename; // Store only the filename in the database
            } else {
                $photoPath = null;
            }
                    }

        // Create Customer with Hashed Password
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'country' => $request->country,
            'photo' => $photoPath,
        ]);
       

        return redirect()->route('admin.customer_view')->with('success', 'Customer added successfully.');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customer_edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            // 'password' => 'required|min:6',
            'phone' => 'required|numeric',
            'country' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Handle Photo Update
        if ($request->hasFile('photo')) {
            if ($customer->photo) {
                Storage::disk('public')->delete($customer->photo); // Delete old photo
            }
            if ($request->hasFile('photo')) {
                // Delete old photo if it exists
                if ($customer->photo && file_exists(public_path('uploads/customers/' . $customer->photo))) {
                    unlink(public_path('uploads/customers/' . $customer->photo));
                }
            
                // Store new photo
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/customers'), $filename);
                $customer->photo = $filename; // Store only filename
            }
                    }

        // Update password only if a new one is provided
        if ($request->password) {
            $customer->password = Hash::make($request->password);
        }

        // Update other fields
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
        ]);

        return redirect()->route('admin.customer_view')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        // Delete Customer Photo if Exists
        if ($customer->photo) {
            if ($customer->photo && file_exists(public_path('uploads/customers/' . $customer->photo))) {
                unlink(public_path('uploads/customers/' . $customer->photo)); // Deletes the file
            }
                    }

        $customer->delete();

        return redirect()->route('admin.customer_view')->with('success', 'Customer deleted successfully.');
    }
}
