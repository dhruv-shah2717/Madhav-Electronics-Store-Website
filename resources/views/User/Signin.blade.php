@extends('User/Master')

@section('section')

<!-- Start of Signin Section -->
    <section class="signinup-section Dhruv">
        <div class="container Size">
            <div class="row">
                <!-- Image Section -->
                <div class="col-md-6 image-container">
                    <div class="image">
                        <img src="{{ asset('Images/Background/UpIn.png') }}" class="img-fluid" alt="Sign In Background">
                    </div>
                </div> 

                <!-- Sign In Form Section -->
                <div class="col-md-6">
                    <div class="form-container">
                        <div class="align-items-center">
                            <div class="heading mb-4">
                                <h5>Sign In</h5>
                            </div>

                            <!-- Sign In Form -->
                            <form action="{{ route('signin.action') }}" class="user-form" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" placeholder="Enter your email" name="email" value="{{ old('email') }}" class="form-input Dinput">
                                    <div class="error">
                                        @error('email')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Link to Sign Up -->
                                <div class="signinup">
                                    <a href="{{ route('signup') }}">Sign Up</a>
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
<!-- End of Signin Section -->

@endsection