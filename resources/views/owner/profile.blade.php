@extends('owner.layout.app')

@section('heading', 'Edit Profile')

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('owner_profile_submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 text-center">
                                {{-- Show profile image if available, otherwise show a default image --}}
                                @php
                                    $owner = Auth::guard('owner')->user();
                                    $profileImage = $owner->image ? asset('uploads/'.$owner->image) : asset('uploads/default-avatar.png');
                                @endphp
                                <img src="{{ $profileImage }}" alt="Profile Image" class="rounded-circle img-fluid border p-2" style="width: 250px; height: 250px; object-fit: cover;">
                            
                                <label class="form-label mt-3">Update Profile Image</label>
                                <input type="file" class="form-control mt-2" name="image" accept="image/*">
                            </div>
                            
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ $owner->name }}" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" name="email" value="{{ $owner->email }}" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">New Password (Optional)</label>
                                    <input type="password" class="form-control" name="password" placeholder="Leave blank to keep the same">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Retype Password</label>
                                    <input type="password" class="form-control" name="retype_password">
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-primary w-100 h-300">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Show success or error messages --}}
                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
