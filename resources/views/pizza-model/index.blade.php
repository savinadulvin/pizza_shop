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
                            <th scope="col">Name</th>
                            <th scope="col">Size</th>
                            <th scope="col">Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizza_models as $pizza_model)
                            <tr>
                                <th scope="row">{{ $pizza_model->id }}</th>
                                <td>
                                    
                                        {{ $pizza_model->manufacturer->name }}
                                    
                                </td>
                                <td>{{ $pizza_model->name }}</td>
                                <td>{{ $pizza_model->description }}</td>
                                <td>{{ $pizza_model->is_active ? 'Published' : 'Not Published' }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pizza_models->links() }}
            </div>
        </div>
    </div>
@endsection