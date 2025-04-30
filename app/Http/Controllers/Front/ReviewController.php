<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Room;

class ReviewController extends Controller
{
   
public function show($id)
{
    $single_room_data = Room::with([
        'reviews.customer',   // Load customer data for reviews
        'reviews.replies.admin' // Load replies and the admin who posted them
    ])->findOrFail($id);

    $hasBooked = false;
    if (Auth::guard('customer')->check()) {
        $customer_id = Auth::guard('customer')->id();
        $hasBooked = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.customer_id', $customer_id)
            ->where('order_details.room_id', $id)
            ->exists();
    }

    return view('front.room_detail', compact('single_room_data', 'hasBooked'));
}
//     public function edit($id)
// {
//     $review = Review::where('id', $id)->where('customer_id', Auth::guard('customer')->id())->firstOrFail();
//     return view('reviews.edit', compact('review'));
// }

// public function update(Request $request, $id)
// {
//     $request->validate([
//         'rating' => 'required|integer|min:1|max:5',
//         'review' => 'required|string|max:500',
//     ]);

//     $review = Review::where('id', $id)->where('customer_id', Auth::guard('customer')->id())->firstOrFail();
//     $review->update([
//         'rating' => $request->rating,
//         'review' => $request->review,
//     ]);

//     return redirect()->back()->with('success', 'Review updated successfully!');
// }

public function destroy($id)
{
    $review = Review::where('id', $id)->where('customer_id', Auth::guard('customer')->id())->firstOrFail();
    $review->delete();

    return redirect()->back()->with('success', 'Review deleted successfully!');
}

public function store(Request $request)
{
    // ✅ 1. Check if the user is logged in as customer
    if (!Auth::guard('customer')->check()) {
        return redirect()->back()->with('error', 'You must be logged in to leave a review.');
    }

    $customer_id = Auth::guard('customer')->id();

    // ✅ 2. Check if this customer actually booked this room
    $hasBooked = DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->where('orders.customer_id', $customer_id)
        ->where('order_details.room_id', $request->room_id)
        ->exists();

    if (!$hasBooked) {
        return redirect()->back()->with('error', 'You can only review rooms you have booked.');
    }

    // ✅ 3. Validate the request
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'required|string|max:1000',
        'room_id' => 'required|exists:rooms,id'
    ]);

    // ✅ 4. Create the review
    Review::create([
        'customer_id' => $customer_id,
        'room_id' => $request->room_id,
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}

}  