@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Pizza Shop</h1>
                 @can('accessCustomerFeatures')
                     <h1 class="display-5 fw-bold">Welcome {{ auth()->user()->name }}</h1>
                 @elsecan('accessAdminFeatures')
                     <h1 class="display-5 fw-bold">Welcome Admin : {{ auth()->user()->name }}</h1>
                 @else
                     
                 @endcan
                 <br>
                <p class="col-md-8 fs-4">
                    Preparing pizza dough, sauces, and various toppings, such as tomatoes, 
                    peppers, mushrooms, onions, and meats. Monitoring the temperature of the pizza 
                    ovens as well as cooking times. Preparing high-quality pizzas according to company 
                    recipes. Monitoring inventory and placing orders for more supplies as needed.

                </p>

                <div class="row">
                    @if ($products && $products->count())
                        @foreach ($products as $product)
                            <div class="col-4">
                                <div class="card mx-1">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                            alt="...">
                                    @endif
                                    <div class="bg-warning card-body">
                                        <h5 class="card-title">
                                            {{ $product->name }}
                                        </h5>
                                        <p class="card-text">{{ $product->summary }}</p>

                                        <h4>£ {{ number_format($product->price, 2) }}</h4>

                                        @auth
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf

                                                @if ($product->pizzaModel->pizzaAddons)
                                                    <ul>
                                                        @foreach ($product->pizzaModel->pizzaAddons as $addOn)
                                                        
                                                            <li>
                                                                <input type="checkbox" name="pizza_addons[]"
                                                                    value="{{ $addOn->id }}">
                                                                {{ $addOn->name }}
                                                                £{{ number_format($addOn->value, 2) }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="number" name="quantity" value="1" />
                                                <button type="submit" class="btn btn-primary btn-lg mt-4">
                                                    Add To Cart
                                                </button>
                                            </form>
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-4">
                                                Login to Buy
                                            </a>
                                        @endguest

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection









