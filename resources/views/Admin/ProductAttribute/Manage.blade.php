@extends('Admin/Master')

@section('section')

<!-- Start of Manage Product Attribute Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Attributes</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Attribute Name</th>
                                        <th scope="col">Attribute Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1; // Initialize counter for row numbering
                                    @endphp

                                    @foreach($data['proatu'] as $tem)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $tem->product->product_name }}</td> <!-- Accessing product name through relationship -->
                                            <td>{{ $tem->attribute_name }}</td>
                                            <td>₹ {{ number_format($tem->attribute_price) }}</td> <!-- Format price -->
                                            <td>
                                                <a href="{{ route('edit.proatu', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </a>
                                                <a href="{{ route('delete.proatu', $tem->_id) }}">
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
<!-- End of Manage Product Attribute Section -->

@endsection