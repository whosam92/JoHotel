@extends('owner.layout.app')

@section('heading', 'Add New Coupon')

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('owner.coupon_store') }}" method="POST">
                        @csrf

                        <!-- Coupon Code -->
                        <div class="mb-3">
                            <label class="form-label">Coupon Code *</label>
                            <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
                        </div>

                        <!-- Discount Amount -->
                        <div class="mb-3">
                            <label class="form-label">Discount Amount *</label>
                            <input type="number" name="discount_amount" class="form-control" value="{{ old('discount_amount') }}" required>
                        </div>

                        <!-- Discount Type -->
                        <div class="mb-3">
                            <label class="form-label">Discount Type *</label>
                            <select name="discount_type" class="form-control" required>
                                <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                            </select>
                        </div>

                        <!-- Hotel Selection -->
                        <div class="mb-3">
                            <label class="form-label">Hotel *</label>
                            <select name="hotel_id" class="form-control" required>
                                <option value="">Select a hotel</option>
                                @foreach($hotels as $hotel)
                                    <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                        {{ $hotel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" class="form-control" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Submit & Back Buttons -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Coupon</button>
                            <a href="{{ route('owner.coupon_index') }}" class="btn btn-secondary">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
