@extends('Admin/Master')

@section('section')

<!-- Start of Manage Product Image Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All Product Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1; // Initialize counter for row numbering
                                    @endphp

                                    @foreach($data['proimg'] as $tem)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>
                                                <img src="{{ asset($tem->image_path) }}" alt="Product Image" style="height: 100px; width: 100px;">
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.proimg', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </a> 
                                                @if(count($data['proimg']) > 1)
                                                    <a href="{{ route('delete.proimg', $tem->_id) }}">
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @php
                                            $i++; // Increment counter
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End of Manage Product Image Section -->

@endsection