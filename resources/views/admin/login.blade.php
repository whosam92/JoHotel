@extends('front.layout.app')

@section('main_content')

<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Admin Panel Login</h2> 
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
               
                @if(session()->get('success'))
                <div class="text-success">{{ session()->get('success') }}</div>
                @endif
                <form  action="{{ route('admin_login_submit') }}" method="post">
                    @csrf
                    <div class="login-form">
                        <div class="mb-3">
                            <label for="" class="form-label">Email Address</label>
                            <input type="text" class="form-control" name="email">
                            @if($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary bg-website">Login</button>
                            {{-- <a href="{{ route('customer_forget_password') }}" class="primary-color">Forget Password?</a> --}}
                        </div>
                        <div class="form-group">
                            <div>
                                <a href="{{ route('admin_forget_password') }}" class="text-dark">
                                    Forget Password?
                                </a>
                            </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>





@endsection