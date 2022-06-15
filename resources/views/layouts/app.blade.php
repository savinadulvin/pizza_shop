<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-warning shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="row pt-3">
                        <div class="col-6">
                            <img src="{{ asset('/images/logo.jpg') }}"
                                style="width: 150px;"
                                alt="{{ config('app.name', 'Laravel') }}">
                        </div>
                        <div class="col-6">
                            <br>
                            <h3> Pizza Shop</h3>
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @can('accessAdminFeatures')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Adminstration
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <li class="text-black-50 ps-3">Authentication</li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="text-black-50 ps-3">Product</li>
                                    <li><hr class="dropdown-divider"></li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('pizza-models.index') }}">Categories</a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('pizzas.index') }}">Pizza</a>
                                    </li>


                                    <li><hr class="dropdown-divider"></li>
                                    <li class="text-black-50 ps-3">E-Commerce</li>
                                    <li><hr class="dropdown-divider"></li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('orders.index') }}">Orders</a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                    
                    </ul>

                    <ul class="navbar-nav ms-auto">

                        @if (session('cart_id'))
                            <li>
                                <a class="nav-link" href="{{ route('cart.show', session()->get('cart_id')) }}">
                                    <i class="ri-shopping-cart-line"></i> My Cart
                                    <span class="badge badge-pill badge-danger"></span>
                                </a>
                            </li>
                        @endif

                        
                            <li>
                                <a class="nav-link" href="{{ route('orders.history', session()->get('user_id')) }}">
                                    <i class="ri-order-line"></i> My Orders
                                    <span class="badge badge-pill badge-danger"></span>
                                </a>
                            </li>   
                        
                        
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (session()->has('success'))
            <div class="container mt-4">
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <div>
                        <i class="ri-check-double-line"></i>
                        {{ session()->get('success') }}
                    </div>
                </div>
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>





