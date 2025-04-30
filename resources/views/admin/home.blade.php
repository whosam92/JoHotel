@extends('admin.layout.app')

@section('heading', 'Dashboard')

@section('main_content')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Custom Styles -->
<style>
    .card-icon i {
        color: #E75542 !important;
        font-size: 2rem;
    }

    .navbar-bg {
        background-color: #585858 !important;
    }
</style>

<!-- Dashboard Cards -->
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-light">
                <i class="fa-solid fa-cart-plus"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Completed Bookings</h4>
                </div>
                <div class="card-body">
                    {{ $total_completed_orders }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-light">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Revenue</h4>
                </div>
                <div class="card-body">
                    ${{ number_format($total_revenue, 2) }}
                </div>                    
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-light">
                <i class="fa-solid fa-shopping-cart"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pending Orders</h4>
                </div>
                <div class="card-body">
                    {{ $total_pending_orders }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-light">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Customers</h4>
                </div>
                <div class="card-body">
                    {{ $total_customers }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-light">
                <i class="fa-solid fa-house"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Hotels</h4>
                </div>
                <div class="card-body">
                    {{ $total_hotels }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-light">
                <i class="fa-solid fa-hotel"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Rooms</h4>
                </div>
                <div class="card-body">
                    {{ $total_rooms }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="row mt-5">
    <div class="col-md-12">
        <section class="section">
            <div class="section-header">
                <h1>Recent Orders</h1>
            </div>
        </section>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Order No</th>
                                            <th>Payment Method</th>
                                            <th>Booking Date</th>
                                            <th>Paid Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->order_no }}</td>
                                            <td>{{ $row->payment_method }}</td>
                                            <td>{{ $row->booking_date }}</td>
                                            <td>${{ number_format($row->paid_amount, 2) }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin_order_delete', $row->id) }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    {{-- Optional View Details --}}
                                                    {{-- <a href="{{ route('admin_invoice', $row->id) }}" class="btn btn-sm btn-primary" title="View Details">
                                                        <i class="fa fa-eye"></i>
                                                    </a> --}}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $orders->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection
