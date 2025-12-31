@extends('Admin/Master')

@section('section')

<!-- Start of Manage Subcategory Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All Subcategories</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Subcategory Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1; // Initialize counter for row numbering
                                    @endphp

                                    @foreach($data['subcat'] as $tem)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $tem->category->category_name }}</td> <!-- Accessing category name through relationship -->
                                            <td>{{ $tem->subcategory_name }}</td>
                                            <td>
                                                <a href="{{ route('edit.subcat', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </a>
                                                <a href="{{ route('delete.subcat', $tem->_id) }}">
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
<!-- End of Manage Subcategory Section -->

@endsection