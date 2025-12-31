@extends('Admin/Master')

@section('section')

<!-- Start of Manage Discount Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All Discounts</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Discount Name</th>
                                        <th scope="col">Discount Price</th>
                                        <th scope="col">Discount Expiry Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1; // Initialize counter for row numbering
                                    @endphp

                                    @foreach($data['dis'] as $tem)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $tem->discount_name }}</td>
                                            <td>₹ {{ number_format($tem->discount_price) }}</td> <!-- Format price -->
                                            <td>{{ \Carbon\Carbon::parse($tem->discount_expire)->format('d-m-Y') }}</td> <!-- Format date -->
                                            <td>
                                                <a href="{{ route('edit.dis', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </a>
                                                <a href="{{ route('delete.dis', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </a>
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
<!-- End of Manage Discount Section -->

@endsection