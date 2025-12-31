<!-- Shree Ganashi Nam -->
<!-- Mahek -->

@php
    use App\Models\RegisterUser ;
    $name = RegisterUser ::where('user_email', session('Uemail'))->first();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('Css/Cart.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Contact.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Default.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Footer.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Home.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Order.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Payment.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Product.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Profile.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Shop.css') }}">
    <link rel="stylesheet" href="{{ asset('Css/Signinup.css') }}">

    <!-- Title Logo -->
    <link rel="icon" href="{{ asset('Images/Logo/Footerlogo.png') }}" type="image/png">
    <title>Madhav Online Shopping Site</title>
</head>
<body>

    <!-- Bootstrap Popper and JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- Start of Navbar Section -->
    <section class="navbar-section fixed-top">
        <!-- Top Banner -->
        <div class="top-banner">
            <div class="container d-flex justify-content-between">
                Free shipping & 30-day return guarantee.
                <ul class="banner-links d-flex m-0 list-unstyled gap-md-4 gap-2">
                    @if(session()->has('Uemail'))
                        <li><a href="{{ route('profile') }}"><i class="bi bi-person-fill"></i> {{ $name['user_name'] }}</a></li>
                    @else
                        <li><a href="{{ route('signin') }}">SIGN IN</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="main-navbar navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo -->
                <div class="navbar-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('Images/Logo/Logo.png') }}" alt="Brand Logo">
                    </a>
                </div>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="bi bi-list-stars toggle-icon"></i>
                </button>

                <!-- Navigation Items -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="nav-menu navbar-nav mx-auto gap-md-4 gap-sm-3 gap-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('shop', 'search.action', 'price.action') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a>
                        </li>                            
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}" href="{{ route('cart') }}">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('order') ? 'active' : '' }}" href="{{ route('order') }}">Orders</a>
                        </li>
                    </ul>                        

                    <ul class="nav-menu navbar-nav gap-md-2 gap-1">
                        <li class="nav-item">
                            <a class="nav-link" onclick="openSearch()">
                                <i class="bi bi-search"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Search Overlay -->
                    <div id="searchOverlay" class="nav-search-overlay">
                        <span class="close-btn" onclick="closeSearch()" title="Close Overlay">×</span>
                        <div class="nav-search-form">
                            <form action="{{ route('search.action') }}" method="POST">
                                @csrf
                                <input type="text" placeholder="Search for Products, Brands and More" name="search">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <script>
                        function openSearch() {
                            document.getElementById("searchOverlay").style.display = "block";
                        }

                        function closeSearch() {
                            document.getElementById("searchOverlay").style.display = "none";
                        }
                    </script>

                </div>
            </div>
        </nav>
        
        <!-- Alert Messages -->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    {{ session("error") }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </section>    
<!-- End of Navbar Section -->

<!-- Start of Body Section -->
    <div class="space-section" style="padding-bottom: 100px"></div>
    @yield('section')
<!-- End of Body Section -->

<!-- Start of Footer Section -->
    <section class="footer-section">
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <!-- Brand Section -->
                    <div class="footer-brand col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <div class="brand-logo">
                            <img src="{{ asset('Images/Logo/Footerlogo.png') }}" alt="Brand Logo">
                        </div>
                        <p class="brand-description">
                            Customers are at the center of our business, from design to delivery.
                        </p>
                        <div class="payment-methods">
                            <img src="{{ asset('Images/Background/Payment.png') }}" alt="Payment Methods">
                        </div>
                    </div>

                    <!-- Shopping Links Section -->
                    <div class="shopping-links col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <h2 class="footer-heading">Shopping</h2>
                        <ul class="footer-list">
                            <li><a href="#">Electronics Store</a></li>
                            <li><a href="#">Trending Items</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sales</a></li>
                        </ul>
                    </div>

                    <!-- Support Links Section -->
                    <div class="support-links col-lg-3 col-md-6 mb-4 mb-lg-0">
                        <h2 class="footer-heading">Support</h2>
                        <ul class="footer-list">
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivery</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>

                    <!-- Newsletter and Social Links Section -->
                    <div class="newsletter-section col-lg-3 col-md-6">
                        <h2 class="footer-heading">Newsletter</h2>
                        <p class="newsletter-description">
                            Be the first to know about new gadgets, exclusive deals, latest launches, and special promos!
                        </p>
                        <h2 class="footer-heading">Follow Us</h2>
                        <div class="social-icons">
                            <i class="bi bi-whatsapp"></i>
                            <i class="bi bi-instagram"></i>
                            <i class="bi bi-facebook"></i>
                            <i class="bi bi-twitter-x"></i>
                        </div>
                    </div>
                </div>

                <!-- Copyright Section -->
                <div class="copyright text-center">
                    <p>
                        Copyright &copy; 2024 All rights reserved 
                        | This template is made by
                        <span class="love-icon">❤️</span>Dhruv Shah
                    </p>
                    <p>Developed by Mr. Dhruv M Shah.</p>
                </div>
            </div>
        </footer>
    </section>
<!-- End of Footer Section -->

</body>
</html>