@extends('admin.layout.app')

@section('heading', 'View Rooms')

@section('right_top_button')
<a href="{{ route('admin_room_add') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
@endsection

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
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Price (per night)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rooms as $index => $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/'.$row->featured_photo) }}" alt="" class="w_200">
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>${{ $row->price }}</td>
                                    <td class="pt_10 pb_10">
                                        <!-- Detail Button -->
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $loop->iteration }}">Detail</button>

                                        <!-- Gallery Button -->
                                        <a href="{{ route('admin_room_gallery', $row->id) }}" class="btn btn-success">Gallery</a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin_room_edit', $row->id) }}" class="btn btn-primary">Edit</a>

                                        <!-- Delete Form -->
                                        <form action="{{ route('admin_room_delete', $row->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Move the Modal Outside the Table Row -->
                                <div class="modal fade" id="exampleModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Room Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Photo</label></div>
                                                    <div class="col-md-8">
                                                        <img src="{{ asset('uploads/'.$row->featured_photo) }}" alt="" class="w_200">
                                                    </div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Name</label></div>
                                                    <div class="col-md-8">{{ $row->name }}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Description</label></div>
                                                    <div class="col-md-8">{!! $row->description !!}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Price (per night)</label></div>
                                                    <div class="col-md-8">${{ $row->price }}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Total Rooms</label></div>
                                                    <div class="col-md-8">{{ $row->total_rooms }}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Total Amenities</label></div>
                                                    <div class="col-md-8">
                                                        @php
                                                        $arr = explode(',', $row->amenities);
                                                        @endphp
                                                        @foreach($arr as $amenity_id)
                                                            @php
                                                                $temp_row = \App\Models\Amenity::where('id', $amenity_id)->first();
                                                            @endphp
                                                            @if ($temp_row)
                                                                {{ $temp_row->name }}<br>
                                                            @else
                                                                <span class="text-danger">Amenity with ID {{ $amenity_id }} not found</span><br>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Size</label></div>
                                                    <div class="col-md-8">{{ $row->size }}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Total Beds</label></div>
                                                    <div class="col-md-8">{{ $row->total_beds }}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Total Bathrooms</label></div>
                                                    <div class="col-md-8">{{ $row->total_bathrooms }}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Total Balconies</label></div>
                                                    <div class="col-md-8">{{ $row->total_balconies }}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Total Guests</label></div>
                                                    <div class="col-md-8">{{ $row->total_guests }}</div>
                                                </div>
                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                    <div class="col-md-4"><label class="form-label">Video</label></div>
                                                    <div class="col-md-8">
                                                        <div class="iframe-container1">
                                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $row->video_id }}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
