@extends('admin.layout.app')

@section('heading', 'Customer Orders')

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Order No</th>
                                    <th>Payment Method</th>
                                    <th>Booking Date</th>
                                    <th>Subtotal</th>
                                    <th>Discount</th>
                                    <th>Final Total</th>
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
                                    <td>${{ number_format($row->subtotal, 2) }}</td>
                                    <td class="text-danger">- ${{ number_format($row->discount_amount, 2) }}</td>
                                    <td><b>${{ number_format($row->paid_amount, 2) }}</b></td>
                                    <td class="pt_10 pb_10">
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin_order_invoice', $row->id) }}" class="btn btn-sm btn-primary" title="Invoice">
                                                 <i class="fa fa-file-invoice"></i> </a>
        
        <a href="{{ route('admin_order_edit', $row->id) }}" class="btn btn-sm btn-warning" title="View Details">
            <i class="fa fa-eye"></i>
        </a>

        <a href="{{ route('admin_order_delete', $row->id) }}" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?');">
            <i class="fa fa-trash"></i>
        </a>
    </div>
</td>
                                    
                                                                        
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
