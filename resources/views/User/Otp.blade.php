@extends('User/Master')

@section('section')

<!-- Start of OTP Section -->
    <section class="signinup-section Dhruv">
        <div class="container Size">
            <div class="row">

                <!-- Image Container -->
                <div class="col-md-6 image-container">
                    <div class="image">
                        <img src="{{ asset('Images/Background/UpIn.png') }}" class="img-fluid" alt="Background Image">
                    </div>
                </div> 

                <!-- Form Container -->
                <div class="col-md-6">
                    <div class="form-container">
                        <div class="align-items-center">
                            <div class="heading mb-4">
                                <h5>Verify OTP</h5>
                            </div>

                            <!-- OTP Verification Form -->
                            <form action="{{ route('otp.action') }}" class="user-form" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" placeholder="Enter your OTP" name="otp" value="{{ old('otp') }}" class="form-input Dinput">
                                    <div class="error">
                                        @error('otp')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn submit-button Dbtn" type="submit" name="btn">Verify OTP</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
<!-- End of OTP Section -->

@endsection