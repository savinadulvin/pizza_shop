@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table bg-white table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Manufacturer</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Size</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>
                                   
                                        {{ $product->manufacturer->name }}
                                   
                                </td>
                                <td>
                                  
                                        {{ $product->pizzaModel->name }}
                                    
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->size->name }}</td>
                                <td>{{ $product->is_active ? 'Published' : 'Not Published' }}</td>
                                <td>
                                    <a href="{{ route('pizzas.show', $product->id) }}"
                                        class="btn btn-sm btn-success">View</a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection