@extends('User/Master')

@section('section')

<!-- Start of Shop Section -->
    <section class="shop-section Dhruv">
        <div class="container">
            <div class="row">
                <!-- Sidebar for Search and Categories -->
                <div class="col-12 col-md-3 shop-sidebar">
                    <!-- Search Bar -->
                    <form class="search-form" method="POST" action="{{ route('search.action') }}">
                        @csrf
                        <input type="search" placeholder="Search Brand Category Product" class="form-control shop-search Dinput" name="search" value="{{ $search }}">
                    </form>

                    <!-- Category List -->
                    @foreach($data['cat'] as $tems)
                        <div class="card shop-card">
                            <div class="category-header">
                                <a href="{{ route('shop', $tems->_id) }}">
                                    <p>{{ $tems->category_name }}</p>
                                </a>
                                <p><i class="bi bi-caret-down-fill"></i></p>
                            </div>
                            <ul class="category-list">
                                @foreach($data['subcat']->where('category_id', $tems->_id) as $tem)
                                    <a href="{{ route('shop', [$tems->_id, $tem->_id]) }}">
                                        <li class="category-item">{{ $tem->subcategory_name }}</li>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach

                    <!-- Price Filter -->
                    <div class="card shop-card">
                        <div class="price-header">
                            <p>Price</p>
                        </div>
                        <form action="{{ route('price.action') }}" class="price-form" method="POST">
                            @csrf
                            <input type="range" max="100000" min="0" class="form-range price-range" name="ran" value="{{ isset($data['val']) ? $data['val'] : 0 }}">
                            <div class="d-flex justify-content-between range">
                                <p>₹ 0</p>
                                <p>₹ {{ number_format(50000) }}</p>
                                <p>₹ {{ number_format(100000) }}</p>
                            </div>
                        </form>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const priceRange = document.querySelector(".price-range");
                                const priceForm = document.querySelector(".price-form");

                                priceRange.addEventListener("change", function () {
                                    priceForm.submit();
                                });
                            });
                        </script>
                    </div>

                    <!-- Clear Filter Button -->
                    <div class="card shop-card">
                        <a href="{{ route('shop') }}" style="color: red;">
                            <i class="bi bi-x-lg"></i> Clear Filter
                        </a>
                    </div>
                </div>

                <!-- Product Section -->
                <div class="col-12 col-md-9 product-section">
                    <div class="shop-heading">{{ $data['count'] }} products found</div>

                    @if (!empty($data['count']))
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                            @foreach($data['pro'] as $tem)
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
                    @else
                        <!-- No Products Found -->
                        <div class="d-flex justify-content-center w-100">
                            <img src="{{ asset('Images/Background/Noproduct.png') }}" alt="" style="width:350px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script>
        // Add click event to toggle category visibility
        document.addEventListener('DOMContentLoaded', () => {
            // Initially set all lists to be open by default
            document.querySelectorAll('.shop-section .category-list, .shop-section .subcategory-list').forEach(ul => {
                ul.classList.add('open'); // Add the "open" class to make the lists visible by default
            });

            // Add click event to toggle category visibility
            document.querySelectorAll('.shop-card .category-header').forEach(header => {
                header.addEventListener('click', () => {
                    const ul = header.nextElementSibling; // Get the <ul> following the header
                    if (ul && (ul.classList.contains('category-list') || ul.classList.contains('subcategory-list'))) {
                        ul.classList.toggle('open'); // Toggle the "open" class for smooth transition
                    }
                });
            });
        });
    </script>
<!-- End of Shop Section -->

@endsection