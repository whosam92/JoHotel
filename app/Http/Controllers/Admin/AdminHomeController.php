<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Subscriber;
use PHPUnit\Runner\Hook;

class AdminHomeController extends Controller
{
    
public function index()
{
    $total_completed_orders = Order::where('status', 'Completed')->count();
    $total_pending_orders = Order::where('status', 'Pending')->count();
    $total_revenue = Order::where('status', 'Completed')->sum('paid_amount');
    $total_customers = \App\Models\Customer::count();
    $total_rooms = Room::count();
    $total_hotels = Hotel::count();


    $orders = Order::latest()->take(10)->get();

    return view('admin.home', compact(
        'total_completed_orders',
        'total_pending_orders',
        'total_revenue',
        'total_customers',
        'total_rooms',
        'orders',
        'total_hotels'
    ));
}

   
}
