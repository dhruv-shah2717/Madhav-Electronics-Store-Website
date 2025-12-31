@extends('User/Master')

@section('section')

<!-- Start of Payment Section -->
    <section class="payment-section Dhruv">
        <div class="container Size">
            <div class="row">
                
                <!-- Image Section -->
                <div class="col-md-6 image-container">
                    <div class="image">
                        <img src="{{ asset('Images/Background/AllPayment.png') }}" class="img-fluid" alt="Payment Background">
                    </div>
                </div>

                <!-- Order Summary and Payment Form -->
                <div class="col-md-6">
                    <div class="form-container">
                        <div class="align-items-center">
                            
                            <!-- Order Summary Heading -->
                            <div class="heading mb-4">
                                <h5>Order Summary</h5>
                            </div>

                            <!-- Order Details -->
                            <div class="summary-detail">
                                <p><strong>Amount:</strong> ₹ {{ number_format($data['sub']) }}</p>
                                <p><strong>Order ID:</strong> {{ $data['razorpayOrderId'] }}</p>
                            </div>

                            <!-- Payment Form -->
                            <form action="{{ route('payment.action') }}" method="POST" class="payment-form">
                                @csrf
                                <script
                                    src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ $data['key'] }}"
                                    data-amount="{{ $data['sub'] * 100 }}"
                                    data-currency="INR"
                                    data-order_id="{{ $data['razorpayOrderId'] }}"
                                    data-buttontext="Proceed to Pay"
                                    data-name="Madhav"
                                    data-description="Payment for your order"
                                    data-image="{{ asset('Images/Logo/Logo.png') }}"
                                    data-theme.color="#000000"
                                ></script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of Payment Section -->

@endsection