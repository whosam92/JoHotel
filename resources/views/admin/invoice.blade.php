@extends('admin.layout.app')

@section('heading', 'Order Invoice')

@section('main_content')
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title">
                        <h2>Invoice</h2>
                        <div class="invoice-number">Order #{{ $order->order_no }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                <strong>Invoice To</strong><br>
                                {{ $customer_data->name }}<br>
                                {{ $customer_data->address }}<br>
                                {{ $customer_data->state }}, {{ $customer_data->city }}, {{ $customer_data->zip }}
                            </address>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <address>
                                <strong>Invoice Date</strong><br>
                                {{ $order->booking_date }}
                            </address>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
                    <p class="section-lead">Hotel room information is given below in detail:</p>
                    <hr class="invoice-above-table">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th>SL</th>
                                <th>Room Name</th>
                                <th class="text-center">Checkin Date</th>
                                <th class="text-center">Checkout Date</th>
                                <th class="text-center">Number of Adults</th>
                                <th class="text-center">Number of Children</th>
                                <th class="text-right">Subtotal</th>
                            </tr>

                            @php 
                                $subtotal = 0;
                            @endphp

                            @foreach($order->orderDetails as $item)
                                @php
                                    $room_data = \App\Models\Room::where('id', $item->room_id)->first();
                                    $d1 = explode('/', $item->checkin_date);
                                    $d2 = explode('/', $item->checkout_date);

                                    $d1_new = $d1[2] . '-' . $d1[1] . '-' . $d1[0];
                                    $d2_new = $d2[2] . '-' . $d2[1] . '-' . $d2[0];

                                    $t1 = strtotime($d1_new);
                                    $t2 = strtotime($d2_new);
                                    $diff = ($t2 - $t1) / 86400;

                                    $sub = $room_data->price * $diff;
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $room_data->name }}</td>
                                    <td class="text-center">{{ $item->checkin_date }}</td>
                                    <td class="text-center">{{ $item->checkout_date }}</td>
                                    <td class="text-center">{{ $item->adult }}</td>
                                    <td class="text-center">{{ $item->children }}</td>
                                    <td class="text-right">${{ number_format($sub, 2) }}</td>
                                </tr>

                                @php
                                    $subtotal += $sub;
                                @endphp
                            @endforeach
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-12 text-right">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Subtotal</div>
                                <div class="invoice-detail-value">${{ number_format($subtotal, 2) }}</div>
                            </div>

                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Discount</div>
                                <div class="invoice-detail-value text-danger">- ${{ number_format($order->discount_amount, 2) }}</div>
                            </div>

                            <hr>

                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name"><strong>Final Total</strong></div>
                                <div class="invoice-detail-value invoice-detail-value-lg"><strong>${{ number_format($order->paid_amount, 2) }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="about-print-button">
        <div class="text-md-right">
            <a href="javascript:window.print();" class="btn btn-warning btn-icon icon-left text-white print-invoice-button">
                <i class="fa fa-print"></i> Print
            </a>
            <a href="{{ route('admin_orders') }}" class="btn btn-primary btn-icon icon-left text-white">
                <i class="fa fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
</div>
@endsection
