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
                                    <th>Paid Amount</th>
                                    <th>Customer Name</th> 
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
                                    <td>{{ $row->paid_amount }}</td>
                                    <td>{{ $row->customer->name }}</td> 
                                    <td class="pt_10 pb_10">
                                        {{-- <a href="{{ route('admin_invoice', $row->id) }}" class="btn btn-primary">Detail</a> --}}
                                        
                                        <a href="{{ route('admin.order.edit', $row->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    
                                        <a href="{{ route('admin_order_delete', $row->id) }}" class="btn btn-danger btn-sm" title="Delete" onClick="return confirm('Are you sure?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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
