@extends('User/Master')

@section('section')

<!-- Start of Profile Section -->
    <section class="profile-section Dhruv">
        <div class="container Size">
            <div class="row">

                <!-- Profile Card -->
                <div class="col-lg-4">
                    <div class="card info-card">
                        <div class="profile-info">
                            <img src="{{ asset('Images/Background/Profile.png') }}" alt="Profile Picture" class="info-img">
                            <h5 class="info-name">Hello {{ $data['use']->user_name }}</h5>
                            <div class="info-buttons">
                                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                                <a href="{{ route('logout.user') }}">
                                    <button type="button" class="btn btn-sm btn-outline-danger">Logout</button>
                                </a><br><br>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Details Card -->
                <div class="col-lg-8">
                    <div class="card details-card">
                        <div class="profile-details">
                            <div class="row detail-row">
                                <div class="col-sm-3">
                                    <p class="detail-heading">Full Name:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="detail-text">{{ $data['use']->user_name }}</p>
                                </div>
                            </div>
                            <div class="row detail-row">
                                <div class="col-sm-3">
                                    <p class="detail-heading">Email:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="detail-text">{{ $data['use']->user_email }}</p>
                                </div>
                            </div>
                            <div class="row detail-row">
                                <div class="col-sm-3">
                                    <p class="detail-heading">Address:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="detail-text">{{ $data['use']->user_address }}</p>
                                </div>
                            </div>
                            <div class="row detail-row">
                                <div class="col-sm-3">
                                    <p class="detail-heading">Pincode:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="detail-text">{{ $data['use']->user_pincode }}</p>
                                </div>
                            </div>
                            <div class="row detail-row">
                                <div class="col-sm-3">
                                    <p class="detail-heading">State:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="detail-text">{{ $data['use']->user_state }}</p>
                                </div>
                            </div>
                            <div class="row detail-row">
                                <div class="col-sm-3">
                                    <p class="detail-heading">City/District/Town:</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="detail-text">{{ $data['use']->user_cdt }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModal">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.action') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="uname" placeholder="Dhruv Shah" value="{{ $data['use']->user_name }}">
                                    <div class="error">
                                        @error('uname')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label ">Edit Address</label>
                                    <textarea class="form-control" name="address">{{ $data['use']->user_address }}</textarea>
                                    <div class="error">
                                        @error('address')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Edit Pincode</label>
                                    <input type="text" class="form-control" name="pincode" value="{{ $data['use']->user_pincode }}">
                                    <div class="error">
                                        @error('pincode')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Edit State</label>
                                    <input type="text" class="form-control" name="state" value="{{ $data['use']->user_state }}">
                                    <div class="error">
                                        @error('state')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Edit District</label>
                                    <input type="text" class="form-control" name="cdt" value="{{ $data['use']->user_cdt }}">
                                    <div class="error">
                                        @error('cdt')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 d-flex" style="float: right">
                                    <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Profile Section -->

@endsection