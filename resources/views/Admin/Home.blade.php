@extends('Admin/Master')

@section('section')

<!-- Start Of Card and User Table -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="">
                    <div class="row">

                        <!-- Orders Card -->
                        <div class="col-md-3 col-6">
                            <a href="{{ route('manage.ord') }}" style="text-decoration: none">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Orders</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="box"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ $data['ocount'] }}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Sales Card -->
                        <div class="col-md-3 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Sales</h5>
                                        </div>
                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="align-middle" data-feather="activity"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">₹ {{ number_format($data['scount']) }}</h1>
                                </div>
                            </div>
                        </div>

                        <!-- Contacts Card -->
                        <div class="col-md-3 col-6">
                            <a href="{{ route('manage.con') }}" style="text-decoration: none">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Contacts</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="inbox"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ $data['ccount'] }}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- All Products Card -->
                        <div class="col-md-3 col-6">
                            <a href="{{ route('manage.pro') }}" style="text-decoration: none">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">All Products</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="package"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3">{{ $data['pcount'] }}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- User Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Users</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Role</th>
                                    <th>OTP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['use'] as $tem)
                                    <tr>
                                        <td>{{ $tem->user_name }}</td>
                                        <td>{{ $tem->user_email }}</td>
                                        <td>{{ $tem->user_role }}</td>
                                        <td>{{ $tem->user_otp }}</td>
                                        <td>
                                            <a href="{{ route('edit.use', $tem->_id) }}">
                                                <button class="btn btn-sm btn-primary">Update</button>
                                            </a>
                                            <a href="{{ route('delete.use', $tem->_id) }}">
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!-- End Of Card and User Table -->

@endsection