<!-- Shree Ganashi Nam -->
<!-- Mahek -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Custom CSS -->
    <link href="{{ asset('Css/app.css') }}" rel="stylesheet">
    
    <!-- Title Logo -->
    <link rel="icon" href="{{ asset('Images/Logo/Footerlogo.png') }}" type="image/png">
    <title>Madhav Online Shopping Site</title>
</head>

<body>

<!-- Stat of Navbar, Body, Footer Section -->
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('admin') }}">
                    <img src="{{ asset('Images/Logo/Footerlogo.png') }}" alt="" style="height: 60px; width:200px">
                </a>
                
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-header">Main</li>
                    <li class="sidebar-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('admin') }}">
                            <i class="align-middle" data-feather="sliders"></i>
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- Category -->
                    <li class="sidebar-header">Category</li>
                    <li class="sidebar-item {{ request()->routeIs('create.cat') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('create.cat') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('manage.cat', 'edit.cat') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('manage.cat') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <!-- SubCategory -->
                    <li class="sidebar-header">Sub Category</li>
                    <li class="sidebar-item {{ request()->routeIs('create.subcat') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('create.subcat') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('manage.subcat', 'edit.subcat') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('manage.subcat') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <!-- Product -->
                    <li class="sidebar-header">Product</li>
                    <li class="sidebar-item {{ request()->routeIs('create.pro') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('create.pro') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('manage.pro', 'edit.pro', 'manage.proimg') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('manage.pro') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <!-- Product Attribute -->
                    <li class="sidebar-header">Product Attribute</li>
                    <li class="sidebar-item {{ request()->routeIs('create.proatu') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('create.proatu') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('manage.proatu', 'edit.proatu') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('manage.proatu') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <!-- Discount -->
                    <li class="sidebar-header">Discount</li>
                    <li class="sidebar-item {{ request()->routeIs('create.dis') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('create.dis') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('manage.dis', 'edit.dis') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('manage.dis') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                    <!-- Slider -->
                    <li class="sidebar-header">Silder</li>
                    <li class="sidebar-item {{ request()->routeIs('create.sli') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('create.sli') }}">
                            <i class="align-middle" data-feather="plus"></i>
                            <span class="align-middle">Create</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('manage.sli', 'edit.sli') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('manage.sli') }}">
                            <i class="align-middle" data-feather="list"></i>
                            <span class="align-middle">Manage</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        
        <!-- Main Content -->
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li>
                            <a href="{{ route('logout.admin') }}"><i class="align-middle" data-feather="log-out"></i><span class="align-middle"> Logout</span></a>
                        </li>
					</ul>
				</div>
            </nav>
            
            <main class="content">
                @yield('section')
            </main>
            
            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted"><strong>Madhav</strong></a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
<!-- Stat of Navbar, Body, Footer Section -->

<!-- Link js file -->
<script src="{{ asset('Js/app.js') }}"></script>

</body>
</html>