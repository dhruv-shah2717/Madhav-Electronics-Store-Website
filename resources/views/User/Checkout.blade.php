@extends('User/Master')

@section('section')

<!-- Start of Checkout Section -->
    <section class="checkout-section Dhruv">
        <div class="container">
            <div class="checkout-form">
                <form action="{{ route('checkout.action') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Billing Details -->
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout-title">Billing Details</h6>
                            <div class="row">

                                <div class="address">
                                    <!-- Radio Buttons for Address Selection -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioOption1" onclick="toggleForm()" checked>
                                        <label class="form-check-label" for="radioOption1">Add new address</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="radioOption2" onclick="toggleForm()">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-check-label" for="radioOption2">Fetch from old order</label>
                                            <div id="fetchError" style="display: none;" class="error">
                                                No previous address found!
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>

                                <div id="form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First Name<span class="required">*</span></label>
                                                <input type="text" class="form-control Dinput" placeholder="Dhruv" name="fname" id="fnameInput" value="{{ old('fname') }}">
                                                <div class="error">
                                                    @error('fname')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Last Name<span class="required">*</span></label>
                                                <input type="text" class="form-control Dinput" placeholder="Shah" name="lname" id="lnameInput" value="{{ old('lname') }}">
                                                <div class="error">
                                                    @error('lname')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Email<span class="required">*</span></label>
                                                <input type="email" class="form-control Dinput" placeholder="Dhruvshah@gmail.com" name="ema" id="emailInput" value="{{ old('ema') }}">
                                                <div class="error">
                                                    @error('ema')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Phone<span class="required">*</span></label>
                                                <input type="text" class="form-control Dinput" placeholder="1234567890" name="pho" id="phoneInput" value="{{ old('pho') }}">
                                                <div class="error">
                                                    @error('pho')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Address<span class="required">*</span></label>
                                        <textarea class="form-control Dtextarea" style="height: 100px" name="add" id="addressInput" placeholder="Haveli street jalaram chowk">{{ old('add') }}</textarea>
                                        <div class="error">
                                            @error('add')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <label>District/Town/City<span class="required">*</span></label>
                                        <input type="text" class="form-control Dinput" placeholder="Ahmedabad" name="cdt" id="cityInput" value="{{ old('cdt') }}">
                                        <div class="error">
                                            @error('cdt')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>State<span class="required">*</span></label>
                                                <input type="text" class="form-control Dinput" placeholder="Gujarat" name="sta" id="stateInput" value="{{ old('sta') }}">
                                                <div class="error">
                                                    @error('sta')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Pincode<span class="required">*</span></label>
                                                <input type="text" class="form-control Dinput" placeholder="362720" name="pin" id="pinInput" value="{{ old('pin') }}">
                                                <div class="error">
                                                    @error('pin')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function toggleForm() {
                                        const radioOption1 = document.getElementById('radioOption1').checked;
                                        const radioOption2 = document.getElementById('radioOption2').checked;
                                        const fetchError = document.getElementById('fetchError');
                                
                                        if (radioOption1) {
                                            fetchError.style.display = "none";
                                            document.getElementById('fnameInput').value = "";
                                            document.getElementById('lnameInput').value = "";
                                            document.getElementById('emailInput').value = "";
                                            document.getElementById('phoneInput').value = "";
                                            document.getElementById('addressInput').value = "";
                                            document.getElementById('cityInput').value = "";
                                            document.getElementById('stateInput').value = "";
                                            document.getElementById('pinInput').value = "";
                                        }
                                
                                        if (radioOption2) {
                                            const fullName = "{{ $data['add']->shipped_name ?? '' }}";
                                            
                                            if (fullName) {
                                                fetchError.style.display = "none";
                                                const nameParts = fullName.split(' ');
                                                const firstName = nameParts[0] || "";
                                                const lastName = nameParts.slice(1).join(' ') || "";
                                
                                                document.getElementById('fnameInput').value = firstName;
                                                document.getElementById('lnameInput').value = lastName;
                                                document.getElementById('emailInput').value = "{{ $data['add']->shipped_email ?? '' }}";
                                                document.getElementById('phoneInput').value = "{{ $data['add']->shipped_phone ?? '' }}";
                                                document.getElementById('addressInput').value = "{{ $data['add']->shipped_address ?? '' }}";
                                                document.getElementById('cityInput').value = "{{ $data['add']->shipped_cdt ?? '' }}";
                                                document.getElementById('stateInput').value = "{{ $data['add']->shipped_state ?? '' }}";
                                                document.getElementById('pinInput').value = "{{ $data['add']->shipped_pincode ?? '' }}";
                                            } else {
                                                fetchError.style.display = "block";
                                            }
                                        }
                                    }
                                </script>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="col-lg-4 col-md-6">
                            <div class="order-summary">
                                <h4 class="summary-title">Your Order</h4>
                                <div class="order-products-header">Product <span>Total</span></div>
                                <ul class="product-list">
                                    @php $i = 1; @endphp
                                    @foreach($data['cat'] as $tem)
                                        <li>{{ $i }}. {{ $tem->product->product_name }}<span>₹ {{ number_format($tem->product_price) }}</span></li>
                                        @php $i++; @endphp
                                    @endforeach
                                </ul>
                                <ul class="order-totals">
                                    @if(session('coupon'))
                                        <li style="font-size: 15px">Discount <span style="color: green;">-₹ {{ number_format(session('coupon')) }}</span></li>
                                    @endif
                                    <li>Total <span class="price">₹ {{ number_format($data['sub']) }}</span></li>
                                </ul>
                                <button type="submit" class="btn Dbtn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<!-- End of Checkout Section -->

@endsection