@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                {{-- <a href="{{ route('pizza-models.create') }}" class="btn btn-primary mt-4 mb-4">
                    Add Pizza Category
                </a> --}}
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
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            {{-- <th scope="col">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pizza_models as $pizza_model)
                            <tr>
                                <th scope="row">{{ $pizza_model->id }}</th>
                                <td>
                                    {{-- <a href="{{  route('manufacturers.show', $pizza_model->manufacturer->id) }}"> --}}
                                        {{ $pizza_model->manufacturer->name }}
                                    {{-- </a> --}}
                                </td>
                                <td>{{ $pizza_model->name }}</td>
                                <td>{{ $pizza_model->description }}</td>
                                <td>{{ $pizza_model->is_active ? 'Published' : 'Not Published' }}</td>
                                <td>
                                    {{-- <a href="{{ route('pizza-models.show', $pizza_model->id) }}" class="btn btn-sm btn-success">View</a> --}}
                                    <a href="{{ route('pizza-models.edit', $pizza_model->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    {{-- <form action="{{ route('pizza-models.destroy', $pizza_model->id) }}" method="POST"
                                        id="delete-{{ $pizza_model->id }}-pizza_model" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirm('Are you sure you want to delete {{ $pizza_model->name }} ?') ? document.getElementById('delete-{{ $pizza_model->id }}-pizza_model').submit() : null">
                                            Delete
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pizza_models->links() }}
            </div>
        </div>
    </div>
@endsection