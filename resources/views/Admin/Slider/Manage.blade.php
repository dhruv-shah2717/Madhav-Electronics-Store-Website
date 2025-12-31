@extends('Admin/Master')

@section('section')

<!-- Start of Slider Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Sliders</h5> <!-- Added title for clarity -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Slider Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1; // Initialize counter for row numbering
                                    @endphp

                                    @foreach($data['sli'] as $tem)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>
                                                <img src="{{ asset($tem->slider_image) }}" alt="Slider Image" style="width: 100px;">
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.sli', $tem->_id) }}">
                                                    <button class="btn btn-sm btn-primary">Update</button>
                                                </a>
                                                <a href="{{ route('delete.sli', $tem->_id) }}">
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
<!-- End of Slider Section -->

@endsection