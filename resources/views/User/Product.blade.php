@extends('User/Master')

@section('section')

<!-- Start of Product Section -->
    <section class="product-sections Dhruv">
        <div class="container">
            <div class="row">
                <!-- Product Images Section -->
                <div class="col-12 col-md-5">
                    <div class="product-images">
                        <div class="image-display">
                            <div class="image-showcase">
                                @foreach($data['proimg']->where('product_id', $data['pro']->_id) as $tem)
                                    <img src="{{ asset($tem->image_path) }}" alt="Product Image">
                                @endforeach
                            </div>
                        </div>
                        <div class="image-select">
                            @php $i = 1; @endphp
                            @foreach($data['proimg']->where('product_id', $data['pro']->_id) as $tem)
                                <div class="image-item">
                                    <a href="#" data-id="{{ $i }}">
                                        <img src="{{ asset($tem->image_path) }}" alt="Product Image">
                                    </a>
                                </div>
                                @php $i++; @endphp    
                            @endforeach
                        </div>
                    </div>

                    <!-- Image Selection Script -->
                    <script>
                        const imgs = document.querySelectorAll('.image-select a');
                        const imgBtns = [...imgs];
                        let imgId = 1;

                        imgBtns.forEach((imgItem) => {
                            imgItem.addEventListener('click', (event) => {
                                event.preventDefault();
                                imgId = imgItem.dataset.id;
                                slideImage();
                            });
                        });

                        function slideImage() {
                            const displayWidth = document.querySelector('.image-showcase img:first-child').clientWidth;
                            document.querySelector('.image-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
                        }

                        window.addEventListener('resize', slideImage);
                    </script>
                </div>

                <!-- Product Information Section -->
                <div class="col-12 col-md-7">
                    <div class="product-information">
                        <div class="product-name">
                            <p>{{ $data['pro']->product_name }}</p>
                        </div>
                        
                        <div class="product-review">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <small>(210)</small>
                        </div>

                        <div class="product-des">
                            @php
                                $description = $data['pro']->product_description;
                                $halfLength = floor(strlen($description) / 2);
                                $lastSpace = strrpos($description, ' ', $halfLength - strlen($description));
                                $halfDescription = substr($description, 0, $lastSpace ?: $halfLength);
                            @endphp
                            <p>{{ $halfDescription }}</p>
                        </div>
                        
                        <div class="product-price">
                            <div class="price">₹ {{ number_format($data['price']) }}</div>
                            <div class="xprice"><del>₹ {{ number_format($data['pro']->product_xprice) }}</del></div>
                        </div>

                        <div class="product-option">
                            <select name="atu" id="atuSelect" class="form-select Dinput" onchange="redirectToPrice(this)">
                                <option value="0">Select product variant option</option>
                                
                                @if(count($data['proatu']) > 0)
                                    @foreach($data['proatu'] as $tem)
                                        <option value="{{ $tem->_id }}" @if($tem->_id == $data['sel']) selected @endif>{{ $tem->attribute_name }}</option>
                                    @endforeach
                                @else
                                    <option value="default" @if('Default' == $data['sel']) selected @endif>Default product</option>
                                @endif
                                
                                <input type="hidden" id="id" value="{{ $data['pro']->_id }}">
                            </select>
                            <span id="error-message" style="display: none;" class="error">Please select an attribute before adding to the cart.</span>
                        </div>
                        
                        <!-- Redirect to Price Script -->
                        <script>
                            function redirectToPrice(selectElement) {
                                let id = document.getElementById('id').value;
                                let selectedValue = selectElement.value;
                                if (selectedValue) {
                                    window.location.href = "{{ route('product', ['PLACEHOLDER', 'PLACEHOLDER']) }}"
                                    .replace('PLACEHOLDER', id)
                                    .replace('PLACEHOLDER', selectedValue);
                                }
                            }
                        </script>                

                        <div class="product-buttons">
                            <form action="{{ route('buynow.action') }}" method="POST" id="buynowform">
                                @csrf
                                <input type="hidden" name="cid" value="{{ $data['pro']->_id }}">
                                <input type="hidden" name="cat" value="{{ $data['sel'] }}">
                                <input type="hidden" name="cpri" value="{{ $data['price'] }}">
                                <button class="btn Dbtn" type="submit">Buy Now</button>
                            </form>
                            <form action="{{ route('addcart.action') }}" method="POST" id="addToCartForm">
                                @csrf
                                <input type="hidden" name="cid" value="{{ $data['pro']->_id }}">
                                <input type="hidden" name="cat" value="{{ $data['sel'] }}">
                                <input type="hidden" name="cpri" value="{{ $data['price'] }}">
                                <button class="btn Dbtn" type="submit">Add To Cart</button>
                            </form>
                        </div>

                        <!-- Form Validation Scripts -->
                        <script>
                            document.getElementById('addToCartForm').addEventListener('submit', function(event) {
                                let selectElement = document.getElementById('atuSelect');
                                let selectedValue = selectElement.value;
                                let errorMessage = document.getElementById('error-message');

                                if (selectedValue == "0" || selectedValue == "") {
                                    event.preventDefault();
                                    errorMessage.style.display = 'block';
                                } else {
                                    errorMessage.style.display = 'none';
                                }
                            });

                            document.getElementById('buynowform').addEventListener('submit', function(event) {
                                let selectElement = document.getElementById('atuSelect');
                                let selectedValue = selectElement.value;
                                let errorMessage = document.getElementById('error-message');

                                if (selectedValue == "0" || selectedValue == "") {
                                    event.preventDefault();
                                    errorMessage.style.display = 'block';
                                } else {
                                    errorMessage.style.display = 'none';
                                }
                            });
                        </script>

                        <div class="Dbor" style="margin:35px 0px;"></div>

                        <div class="product-attribute">
                            <table>
                                <tr>
                                    <td class="heading">Category :</td>
                                    <td class="des">{{ $data['pro']->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <td class="heading">SubCategory :</td>
                                    <td class="des">{{ $data['pro']->subcategory->subcategory_name }}</td>
                                </tr>
                                <tr>
                                    <td class="heading">Brand :</td>
                                    <td class="des">{{ $data['pro']->product_brand }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="Dbor" style="margin:35px 0px;"></div>

                <div class="product-description">
                    <div class="heading">Description :</div>
                    <p>{{ $data['pro']->product_description }}</p>
                </div>

                <div class="Dbor" style="margin:35px 0px;"></div>

                <div class="product-reviews">
                    <div class="heading mb-3">Reviews :</div>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
                        <div class="col">
                            <div class="card review-card">
                                <div class="card-body">
                                    <p>Dhruv Shah</p>
                                    <div class="reviews">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <div class="comment">I have been using this laptop for over 10 days now and I am totally happy with the system. Like the clean look and feel. Screen is nice Anti glare and it’s awesome. The main highlight about the keyboard is having a full numeric keyboard on the right side. Did around 5 hours of gaming (Cyberpunk 2077) so far and it handles it perfectly on medium-high 1080p settings.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card review-card">
                                <div class="card-body">
                                    <p>Krisha Javiya</p>
                                    <div class="reviews">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <div class="comment">I found it nice in quality, battery is average but nice, Screen is nice 144hz but has only 45% srgb also not seen any of black light bleeding, performance is good I can say not very good, but 6gb of 3050 gives it win - win situation and its safe as its amd cpu, there is no case of motherboard dead issues reported like Intel ones.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of Product Section -->

<!-- Start of Related Product Section -->
    <section class="product-section Dhruv">
        <div class="container">
            <div class="product-heading">Related Products</div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                @foreach($data['relpro'] as $tem)
                    @php
                        $productImage = $data['proimg']->firstWhere('product_id', $tem->_id);
                    @endphp

                    @if($productImage)
                        <!-- Product Card -->
                        <a href="{{ route('product', $tem->_id) }}">
                            <div class="col">
                                <div class="card product-card">
                                    <div class="card-image">
                                        <img src="{{ asset($productImage->image_path) }}" alt="Product Image" class="img-fluid">
                                    </div>
                                    <div class="card-body">
                                        <div class="product-title">{{ $tem->product_name }}</div>
                                        <div class="product-price-rating">
                                            <div class="product-price">₹ {{ number_format($tem->product_price) }}</div>
                                            <div class="product-rating">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <span class="rating-value">(4.5)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
<!-- End of Related Product Section -->

@endsection