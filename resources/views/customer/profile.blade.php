@extends('customer.layout.app')

@section('heading', 'Edit Profile')

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('customer_profile_submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                @php
                                if(Auth::guard('customer')->user()->photo != '') {
                                    $customer_photo = Auth::guard('customer')->user()->photo;
                                } else {
                                    $customer_photo = 'default.png';
                                }
                                @endphp
                                <img src="{{ asset('uploads/'.$customer_photo) }}" alt="" class="profile-photo w_100_p">
                                <input type="file" class="form-control mt_10" name="photo">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Name *</label>
                                            <input type="text" class="form-control" name="name" value="{{ Auth::guard('customer')->user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Email *</label>
                                            <input type="text" class="form-control" name="email" value="{{ Auth::guard('customer')->user()->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{{ Auth::guard('customer')->user()->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" name="country" value="{{ Auth::guard('customer')->user()->country }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{ Auth::guard('customer')->user()->address }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" name="state" value="{{ Auth::guard('customer')->user()->state }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" name="city" value="{{ Auth::guard('customer')->user()->city }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Zip</label>
                                            <input type="text" class="form-control" name="zip" value="{{ Auth::guard('customer')->user()->zip }}">
                                        </div>
                                    </div>
                                </div>
{{-- validate password js--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">           
                                            <label class="form-label">Password</label>
                                            <input type="password" 
                                            class="form-control" 
                                            name="password" 
                                            id="password"
                                            pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z\d]).{6,}$"
                                            title="Password must be at least 6 characters, include letters, numbers, and special characters.">
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Retype Password</label>
                                            <input type="password" class="form-control" name="retype_password" id="retype_password">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@error('password')
    <div class="text-danger">{{ $message }}</div>
@enderror


// js validation scritp for pwd 
<script>
    document.querySelector("form").addEventListener("submit", function(e) {
        const password = document.getElementById("password").value;
        const retype = document.getElementById("retype_password").value;

        if (password !== retype) {
            e.preventDefault();
            alert("Passwords do not match.");
        }
    });
</script>
