@extends('User/Master')

@section('section')

<!-- Start of Map, Information, Contact Form Section -->
    <section class="contact-section Dhruv">
        <!-- Map Section -->
        <div class="contact-map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59669.63730216245!2d70.69348545!3d20.8174743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be2d93ac5833031%3A0x48916fb7e9a5eaad!2sKodinar%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1735807862055!5m2!1sen!2sin" 
                width="100%" 
                height="580" 
                style="border:0;" 
                allowfullscreen="" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <div class="container">
            <div class="contact-details">
                <div class="row">

                    <!-- Contact Information -->
                    <div class="col-md-6">
                        <div class="contact-info">
                            <div class="contact-header">
                                <span class="contact-label">Information</span>
                                <h2 class="contact-heading">Contact Us</h2>
                                <p class="contact-description">
                                    Tech Solutions Inc.: Customer Service Department Suite 300, 4th Floor, Innovation Tower 789 Corporate Boulevard Silicon Valley Business District San Francisco, CA 94105 United States
                                </p>
                            </div>
                            <ul class="contact-informations">
                                <li class="information-item">
                                    <h4 class="information-name">Phone :</h4>
                                    <p class="information-details">
                                        +91 925-423-9893<br>
                                        +91 982-314-0958
                                    </p>
                                </li>
                                <li class="information-item">
                                    <h4 class="information-name">Email :</h4>
                                    <p class="information-details">
                                        Dhruvddadshah2717@gmail.com
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="col-md-6">
                        <div class="contact-form">
                            <form action="{{ route('addcontact.action') }}" method="POST" class="contact-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Enter your full name" class="form-input Dinput" name="fname" value="{{ old('fname') }}">
                                        <div class="error">
                                            @error('fname')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Enter your email" class="form-input Dinput" name="email" value="{{ old('email') }}">
                                        <div class="error">
                                            @error('email')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <textarea placeholder="Enter your message" class="form-textarea Dtextarea" name="message">{{ old('message') }}</textarea>
                                        <div class="error">
                                            @error('message')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn submit-btn Dbtn">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
<!-- End of Map, Information, Contact Form Section -->

@endsection