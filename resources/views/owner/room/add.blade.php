@extends('owner.layout.app')

@section('heading', 'Add Room')

@section('right_top_button')
<a href="{{ route('owner_room_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View All</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('owner_room_store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Featured Photo -->
                                <div class="mb-4">
                                    <label class="form-label">Photo *</label>
                                    <input type="file" name="featured_photo" class="form-control" required>
                                </div>

                                <!-- Room Name -->
                                <div class="mb-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                </div>

                                <!-- Room Description -->
                                <div class="mb-4">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control snote" cols="30" rows="5" required>{{ old('description') }}</textarea>
                                </div>

                                <!-- Price -->
                                <div class="mb-4">
                                    <label class="form-label">Price *</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price') }}" required min="0">
                                </div>

                                <!-- Select Hotel -->
                                <div class="mb-4">
                                    <label class="form-label">Select Hotel *</label>
                                    <select name="hotel_id" class="form-control" required>
                                        <option value="">-- Select Hotel --</option>
                                        @foreach($hotels as $hotel)
                                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Total Rooms -->
                                <div class="mb-4">
                                    <label class="form-label">Total Rooms *</label>
                                    <input type="number" class="form-control" name="total_rooms" value="{{ old('total_rooms') }}" required min="1">
                                </div>

                                <!-- Amenities -->
                                <div class="mb-4">
                                    <label class="form-label">Amenities</label>
                                    @foreach($all_amenities as $index => $item)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="defaultCheck{{ $index }}" name="arr_amenities[]">
                                        <label class="form-check-label" for="defaultCheck{{ $index }}">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Room Details -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Room Size</label>
                                            <input type="text" class="form-control" name="size" value="{{ old('size') }}">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Total Beds</label>
                                            <input type="number" class="form-control" name="total_beds" value="{{ old('total_beds') }}" min="0">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Total Bathrooms</label>
                                            <input type="number" class="form-control" name="total_bathrooms" value="{{ old('total_bathrooms') }}" min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Total Balconies</label>
                                            <input type="number" class="form-control" name="total_balconies" value="{{ old('total_balconies') }}" min="0">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Total Guests</label>
                                            <input type="number" class="form-control" name="total_guests" value="{{ old('total_guests') }}" min="0">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Video Id</label>
                                            <input type="text" class="form-control" name="video_id" value="{{ old('video_id') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-4 text-center">
                                    <button type="submit" class="btn btn-primary">Submit Room</button>
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
