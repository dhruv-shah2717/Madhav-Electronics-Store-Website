@extends('User/Master')

@section('section')

<!-- Start of Cart Section -->
    <section class="cart-section Dhruv">
        <div class="container">

            @if(count($data['car']) > 0)
                <div class="row">
                    <!-- Cart Table -->
                    <div class="col-lg-8">
                        <div class="cart-table">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th class="table-heading">Product</th>
                                            <th class="table-heading">Price</th>
                                            <th class="table-heading">Quantity</th>
                                            <th class="table-heading">Total</th>
                                            <th class="table-heading"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @php 
                                            $total = 0; // Initialize total variable
                                            $coupon = session('coupon'); // Get coupon from session
                                        @endphp

                                        @foreach($data['car'] as $tem)
                                            @php
                                                $pid = $tem->product_id; // Get product ID
                                                $productImage = $data['proimg']->firstWhere('product_id', $pid); // Get product image
                                            @endphp

                                            @if($productImage)
                                                <tr>
                                                    <!-- Product Details -->
                                                    <td class="cart-item">
                                                        <div class="item-details">
                                                            <div class="item-image">
                                                                <img src="{{ asset($productImage->image_path) }}" alt="Product Image">
                                                            </div>
                                                            <div class="item-description">
                                                                {{ $tem->product->product_name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="item-price">
                                                        <p>₹ {{ number_format($tem->product_price) }}</p>
                                                    </td>
                                                    <td class="item-quantity">
                                                        <div class="pro-qty quantity-controls">
                                                            <span class="dec quantity-decrement">&lt;</span>
                                                            <input type="text" readonly value="{{ $tem->product_qty }}" class="quantity-input" min="1" max="5" name="qty" data-pid="{{ $tem->_id }}">
                                                            <input type="hidden" value="{{ $tem->_id }}" name="pid">
                                                            <span class="inc quantity-increment">&gt;</span>
                                                        </div>
                                                    </td>
                                                    <td class="item-total">
                                                        <p>₹ {{ number_format($tem->product_price * $tem->product_qty) }}</p>
                                                    </td>
                                                    <td class="item-remove">
                                                        <a href="{{ route('delcart.action', $tem->_id) }}">
                                                            <button class="remove-btn">
                                                                <i class="bi bi-x-lg"></i>
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @php 
                                                    $price = $tem->product_price * $tem->product_qty; // Calculate price for the item
                                                    $total += $price; // Update total
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity Control Script -->
                    <script>
                        $(document).ready(function() {
                            var proQty = $('.pro-qty');

                            // Handling click events on increment and decrement buttons
                            proQty.on('click', '.inc, .dec', function() {
                                var $button = $(this);
                                var $input = $button.siblings('input.quantity-input');
                                var oldValue = parseInt($input.val(), 10);
                                var minValue = parseInt($input.attr('min'), 10);
                                var maxValue = parseInt($input.attr('max'), 10);
                                var newVal;

                                // Increment or decrement value based on button click
                                if ($button.hasClass('inc')) {
                                    newVal = oldValue < maxValue ? oldValue + 1 : maxValue;
                                } else {
                                    newVal = oldValue > minValue ? oldValue - 1 : minValue;
                                }

                                // Update the input field with the new value
                                $input.val(newVal).change(); // Trigger the onchange event
                            });

                            // Handling the onchange event to update the cart
                            $('.quantity-input').on('change', function() {
                                var newValue = $(this).val();
                                var productId = $(this).data('pid'); // Get the product ID from the data attribute
                                window.location.href = "{{ route('uptcart.action', ['PLACEHOLDER', 'PLACEHOLDER']) }}"
                                    .replace('PLACEHOLDER', newValue)
                                    .replace('PLACEHOLDER', productId);
                            });
                        });
                    </script>

                    <!-- Discount Section -->
                    <div class="col-lg-4">
                        <div class="discount-section">
                            <h6>Discount Codes</h6>
                            <form action="{{ route('appdiscount.action') }}" method="POST">
                                @csrf
                                <input type="text" class="discount-input Dinput" placeholder="Enter your coupon code" name="discount">
                                
                                @if(!session()->has('coupon'))
                                    <button type="submit" class="apply-btn Dbtn">Apply</button>
                                @else
                                    <a href="{{ route('remdiscount.action') }}">
                                        <button class="apply-btn Dbtn" type="button">Remove</button>
                                    </a>
                                @endif 
                                
                                <div class="error">
                                    @error('discount')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="cart-total">
                            <h6>Cart Total</h6>
                            <ul>
                                <li>Total <span>₹ {{ number_format($total) }}</span></li>
                                
                                @if($coupon)
                                    <li>Discount <span style="color: green">-₹ {{ number_format(session('coupon')) }}</span></li>    
                                @endif
                                
                                <li>Subtotal <span>₹ {{ number_format($subtotal = $total - $coupon) }}</span></li>
                            </ul>
                            
                            <form action="{{ route('setsubtotal.action') }}" method="POST">
                                @csrf
                                <input type="hidden" name="sub" value="{{ $subtotal }}">
                                <button class="checkout-btn Dbtn">Proceed to Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>

            @else
                <!-- Empty Cart Message -->
                <div class="d-flex justify-content-center w-100">
                    <img src="{{ asset('Images/Background/Cartempty.png') }}" alt="" style="height: 450px; width: 450px;" class="img-fluid">
                </div>
            @endif

        </div>
    </section>
<!-- End of Cart Section -->

@endsection