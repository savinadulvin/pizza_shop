@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="{{ route('manufacturers.index') }}" class="btn btn-primary mt-4 mb-4">
                    Back
                </a>
            </div>
        </div>
        <div class="row">
            <div class="bg-white col p-4 rounded rounded-2 col-md-8">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $manufacturer->name }}
                        </h5>
                        <p class="card-text">{{ $manufacturer->description }}</p>

                        @if ($manufacturer->image)
                            <img src="{{ asset('storage/' . $manufacturer->image) }}" alt="" style="width: 100px">
                        @endif

                        <h5>Pizza Category</h5>
                        <ul>
                            @foreach ($manufacturer->pizzaModels as $pizzaModel)
                                <li>{{ $pizzaModel->name }}</li>
                            @endforeach
                        </ul>

                        <h5>Pizzas</h5>
                        <ul>
                            @foreach ($manufacturer->pizzas as $pizza)
                                <li>
                                    <a href="{{ route('pizzas.show', $pizza->id) }}">
                                        {{ $pizza->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection