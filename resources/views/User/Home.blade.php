@extends('User/Master')

@section('section')

<!-- Start of Slider Section -->
    <section class="slider-section">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($data['sli'] as $index => $tem)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset($tem->slider_image) }}" alt="Slide" class="d-block w-100">
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container" style="margin-top: -150px">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 g-4 g-md-5">
                @foreach($data['cat'] as $tem)
                    <!-- Product Card -->
                    <a href="{{ route('shop', $tem->_id) }}">
                        <div class="col">
                            <div class="card category-card">
                                <div class="card-image">
                                    <img src="{{ asset($tem->category_image) }}" alt="Product Image" class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <div class="category-title">{{ $tem->category_name }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
<!-- End of Slider Section -->

<!-- Start of New Products Section -->
    <section class="product-section Dhruv">
        <div class="container">
            <div class="product-heading">New Products</div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                @foreach($data['newpro'] as $tem)
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
<!-- End of New Products Section -->

<!-- Start of Banner Section -->
    <section class="banner-section">
        <img src="{{ asset('Images/Background/Banner.jpg') }}" alt="Hero Image" class="hero-image">
    </section>
<!-- End of Banner Section -->

<!-- Start of Trending Products Section -->
    <section class="product-section Dhruv">
        <div class="container">
            <div class="product-heading">Trending Products</div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                @foreach($data['trepro'] as $tem)
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
<!-- End of Trending Products Section -->

<!-- Start of Hero Section -->
    <section class="hero-section Dhruv">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img class="image" src="{{ asset('Images/Background/Hero1.jpg') }}" alt="Slide Image">
                    </div>
                </div>
                <div class="col-lg-6 hero">
                    <div class="hero-content">
                        <h4 class="hero-heading">Exclusive Discounts on Lenovo Legion Item</h4>
                        <p class="hero-text">Gaming Days: Enjoy up to 35% off on high-end gaming laptops, desktops, and accessories. Additionally, receive a 7% cashback up to ₹10,000 and benefit from 6 months of No Cost EMI. You can also get a Legion Monitor and Gaming Mouse bundle for just ₹5,999 (worth ₹27,700) with your favorite gaming PCs.</p>
                        <p class="hero-text collapse" id="collapseExample">For instance, the Lenovo Legion 5, equipped with an Intel Core i7 13th Gen processor, 24 GB RAM, 512 GB SSD, and NVIDIA GeForce RTX 4060 graphics, is available at a special price of ₹1,08,990, down from its original price of ₹1,74,890. This offer includes options for No Cost EMI and exchange benefits.</p>
                        <button class="btn Dbtn" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseExample" aria-expanded="false" 
                        aria-controls="collapseExample">Read More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of Hero Section -->

<!-- Start of Second Hero Section -->
    <section class="hero-section Dhruv">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 hero">
                    <div class="hero-content">
                        <h4 class="hero-heading">Responsive Website Mockup for 'Madhav' Electronics Store</h4>
                        <p class="hero-text">This mockup showcases the 'Madhav' eCommerce website on both a laptop and a mobile phone, highlighting its responsive design. The website adapts perfectly to different screen sizes, offering a seamless shopping experience for electronics. On the laptop, users can explore a full-featured layout with product categories, filters, and a smooth checkout process. On the mobile phone, the design remains clean and user-friendly, making it easy to browse and buy products like mobile phones, laptops, and tablets from anywhere, anytime.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <img class="image" style="height: 500px" src="{{ asset('Images/Background/Hero2.png') }}" alt="Slide Image">
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of Second Hero Section -->

<!-- Start of Feature Section -->
    <section class="feature-section Dhruv">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <div class="col">
                    <div class="feature-card">
                        <div class="row">
                            <div class="col-2">
                                <div class="feature-icon text-center">
                                    <i class="bi bi-truck"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body feature-body">
                                    <h6 class="feature-title">Free Shipping</h6>
                                    <p class="feature-text">For all orders over ₹500</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="feature-card">
                        <div class="row">
                            <div class="col-2">
                                <div class="feature-icon text-center">
                                    <i class="bi bi-wallet2"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body feature-body">
                                    <h6 class="feature-title">Money Back</h6>
                                    <p class="feature-text">If goods have problems</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="feature-card">
                        <div class="row">
                            <div class="col-2">
                                <div class="feature-icon text-center">
                                    <i class="bi bi-clock"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body feature-body">
                                    <h6 class="feature-title">Online Support 24/7</h6>
                                    <p class="feature-text">Dedicated support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="feature-card">
                        <div class="row">
                            <div class="col-2">
                                <div class="feature-icon text-center">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body feature-body">
                                    <h6 class="feature-title">Payment Secure</h6>
                                    <p class="feature-text">100% secure payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- End of Feature Section -->

@endsection