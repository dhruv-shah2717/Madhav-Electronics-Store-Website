@extends('User/Master')

@section('section')

<!-- Start of Signup Section -->
    <section class="signinup-section Dhruv">
        <div class="container">
            <div class="row">
                <!-- Image Section -->
                <div class="col-md-6 image-container">
                    <div class="image">
                        <img src="{{ asset('Images/Background/UpIn.png') }}" class="img-fluid" alt="Sign Up Background">
                    </div>
                </div> 

                <!-- Sign Up Form Section -->
                <div class="col-md-6">
                    <div class="form-container">
                        <div class="align-items-center">
                            <div class="heading mb-4">
                                <h5>Sign Up</h5>
                            </div>

                            <!-- Sign Up Form -->
                            <form action="{{ route('signup.action') }}" class="user-form" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" placeholder="Enter your email" name="email" value="{{ old('email') }}" class="form-input Dinput">
                                    <div class="error">
                                        @error('email')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Link to Sign In -->
                                <div class="signinup">
                                    <a href="{{ route('signin') }}">Sign In</a>
                                </div>

                                <div class="form-group">
                                    <button class="btn submit-button Dbtn" type="submit" name="btn">Send OTP</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
<!-- End of Signup Section -->

@endsection