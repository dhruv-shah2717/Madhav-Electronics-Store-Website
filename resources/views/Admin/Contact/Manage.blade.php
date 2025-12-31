@extends('Admin/Master')

@section('section')

<!-- Start of Manage Contact Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">All Contacts</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Contact Name</th>
                                        <th scope="col">Contact Email</th>
                                        <th scope="col">Contact Message</th>
                                        <th scope="col">Contact Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1; // Initialize counter for row numbering
                                    @endphp

                                    @foreach($data['con'] as $tem)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $tem->contact_name }}</td>
                                            <td>{{ $tem->contact_email }}</td>
                                            <td>{{ $tem->contact_message }}</td>
                                            <td>{{ $tem->contact_status }}</td>
                                            <td>
                                                @if ($tem->contact_status == "Pending")
                                                    <a href="{{ route('edit.con', $tem->_id) }}">
                                                        <button class="btn btn-sm btn-primary">Update</button>
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
<!-- End of Manage Contact Section -->

@endsection