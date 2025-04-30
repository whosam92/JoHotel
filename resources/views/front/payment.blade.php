@extends('front.layout.app')

@section('main_content')

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($global_page_data) && $global_page_data->payment_heading)
                <h2>{{ $global_page_data->payment_heading }}</h2>
            @else
                <h2>Payment</h2> <!-- Default text if data is missing -->
            @endif
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 checkout-left mb_30">


                @php
                $arr_cart_room_id = array();
                $i=0;
                foreach(session()->get('cart_room_id') as $value) {
                    $arr_cart_room_id[$i] = $value;
                    $i++;
                }
                $arr_cart_checkin_date = array();
                $i=0;
                foreach(session()->get('cart_checkin_date') as $value) {
                    $arr_cart_checkin_date[$i] = $value;
                    $i++;
                }
                $arr_cart_checkout_date = array();
                $i=0;
                foreach(session()->get('cart_checkout_date') as $value) {
                    $arr_cart_checkout_date[$i] = $value;
                    $i++;
                }
                $arr_cart_adult = array();
                $i=0;
                foreach(session()->get('cart_adult') as $value) {
                    $arr_cart_adult[$i] = $value;
                    $i++;
                }
                $arr_cart_children = array();
                $i=0;
                foreach(session()->get('cart_children') as $value) {
                    $arr_cart_children[$i] = $value;
                    $i++;
                }
                $total_price = 0;
                for($i=0;$i<count($arr_cart_room_id);$i++)
                {
                    $room_data = DB::table('rooms')->where('id',$arr_cart_room_id[$i])->first();                            
                    $d1 = explode('/',$arr_cart_checkin_date[$i]);
                    $d2 = explode('/',$arr_cart_checkout_date[$i]);
                    $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                    $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                    $t1 = strtotime($d1_new);
                    $t2 = strtotime($d2_new);
                    $diff = ($t2-$t1)/60/60/24;
                    $total_price = $total_price+($room_data->price*$diff);
                }
                @endphp
                        
                <h4>Make Payment</h4>
                <select name="payment_method" class="form-control select2" id="paymentMethodChange" autocomplete="off">
                    <option value="">Select Payment Method</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Stripe">Stripe</option>
                </select>

                <div class="paypal mt_20">
                    <h4>Pay with PayPal</h4>
                    <div id="paypal-button"></div>
                </div>

                <div class="stripe mt_20">
                    <h4>Pay with Stripe</h4>
                    @php
                    $cents = $final_total*100;
                    $customer_email = Auth::guard('customer')->user()->email;
                    $stripe_publishable_key = 'pk_test_51LT28GF67T3XLjgLXbAMW8YNgvDyv6Yrg7mB6yHJhfmWgLrAL79rSBPvxcbKrsKtCesqJmxlOd259nMrNx4Qlhoa00zX7rOhOq';
                    @endphp
                    <form action="{{ route('stripe',$final_total) }}" method="post">
                        @csrf
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ $stripe_publishable_key }}"
                            data-amount="{{ $cents }}"
                            data-name="{{ env('APP_NAME') }}"
                            data-description=""
                            data-image="{{ asset('/public/stripe.png') }}"
                            data-currency="usd"
                            data-email="{{ $customer_email }}"
                        >
                        </script>
                    </form>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 checkout-right">
                {{-- <div class="inner">
                    <h4 class="mb_10">Billing Details</h4>
                    <div>
                        Name: {{ session()->get('billing_name') }}
                    </div>
                    <div>
                        Email: {{ session()->get('billing_email') }}
                    </div>
                    <div>
                        Phone: {{ session()->get('billing_phone') }}
                    </div>
                    <div>
                        Country: {{ session()->get('billing_country') }}
                    </div>
                    <div>
                        Address: {{ session()->get('billing_address') }}
                    </div>
                    <div>
                        State: {{ session()->get('billing_state') }}
                    </div>
                    <div>
                        City: {{ session()->get('billing_city') }}
                    </div>
                    <div>
                        Zip: {{ session()->get('billing_zip') }}
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-4 col-md-4 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Cart Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @php
                                $total_price = session()->get('total_price', 0);
                                $discount = session()->get('discount_amount', 0);
                                $final_total = session()->get('final_total', $total_price);
                                @endphp
                                <tr>
                                    <td><b>Subtotal:</b></td>
                                    <td class="p_price"><b>${{ number_format($total_price, 2) }}</b></td>
                                </tr>
                                @if($discount > 0)
                                <tr>
                                    <td><b>Discount:</b></td>
                                    <td class="p_price text-danger">- ${{ number_format($discount, 2) }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><b>Total:</b></td>
                                    <td class="p_price"><b>${{ number_format($final_total, 2) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
$client = 'ARw2VtkTvo3aT7DILgPWeSUPjMK_AS5RlMKkUmB78O8rFCJcfX6jFSmTDpgdV3bOFLG2WE-s11AcCGTD';
@endphp
<script>
    paypal.Button.render({
        env: 'sandbox',
        client: {
            sandbox: '{{ $client }}',
            production: '{{ $client }}'
        },
        locale: 'en_US',
        style: {
            size: 'medium',
            color: 'blue',
            shape: 'rect',
        },
        payment: function (data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: '{{ $final_total }}',
                        currency: 'USD'
                    }
                }]
            });
        },
        onAuthorize: function (data, actions) {
            return actions.redirect();
        }
    }, '#paypal-button');
    </script>
@endsection