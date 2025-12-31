@extends('Admin/Master')

@section('section')

<!-- Start of Edit User Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.use', $data['use']->_id) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Users</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Enter User Name</h5>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $data['use']->user_name }}">
                                    <div class="error">
                                        @error('name')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Enter Email</h5>
                                    <input type="email" class="form-control" placeholder="Enter Email" readonly value="{{ $data['use']->user_email }}">
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Select Role</h5>
                                    <select class="form-select" name="role">
                                        <option value="User " {{ $data['use']->user_role == 'User ' ? 'selected' : '' }}>User </option>
                                        <option value="Admin" {{ $data['use']->user_role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <div class="error">
                                        @error('role')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Enter OTP</h5>
                                    <input type="text" class="form-control" placeholder="Enter OTP" name="otp" value="{{ $data['use']->user_otp }}">
                                    <div class="error">
                                        @error('otp')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Enter Address</h5>
                                    <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{ $data['use']->user_address }}">
                                    <div class="error">
                                        @error('address')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Enter Pincode</h5>
                                    <input type="text" class="form-control" placeholder="Enter Pincode" name="pincode" value="{{ $data['use']->user_pincode }}">
                                    <div class="error">
                                        @error('pincode')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="mb-2">Enter State</h5>
                                    <input type="text" class="form-control" placeholder="Enter State" name="state" value="{{ $data['use']->user_state }}">
                                    <div class="error">
                                        @error('state')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-2">Enter City/District/Town</h5>
                                    <input type="text" class="form-control" placeholder="Enter CDT" name="cdt" value="{{ $data['use']->user_cdt }}">
                                    <div class="error">
                                        @error('cdt')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Edit User</button>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
<!-- End of Edit User Section -->

@endsection