@extends('admin.layout.app')

@section('heading', 'Customers')

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.customer_create') }}" class="btn btn-primary mb-3">Add New Customer</a>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($row->photo)
                                            <img src="{{ asset('uploads/customers/'.$row->photo) }}" width="50" class="rounded-circle">
                                        @else
                                            <img src="{{ asset('uploads/customers/default.png') }}" width="50" class="rounded-circle">
                                        @endif
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone ?? 'N/A' }}</td>
                                    <td class="pt_10 pb_10">
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.customer_edit', $row->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                    
                                            <form action="{{ route('admin.customer_destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
