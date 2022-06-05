@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table bg-white table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Promotion</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Method</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th>
                            {{-- <th>Collection or Delivery</th> --}}
                            {{-- <th scope="col">Action</th> --}}
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->promotion ? $order->promotion->name : '-' }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->method }}</td>
                                <td>£ {{ number_format($order->discount, 2) }}</td>
                                <td>£ {{ number_format($order->total, 2) }}</td>
                                {{-- <td class="col-sm-1 col-md-1">
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                        id="delete-{{ $order->id }}-product" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <input type="hidden" name="product_id" value="{{ $order->id }}" /> --}}
                                        {{-- <button type="button" class="btn btn-sm btn-danger"
                                            onclick="confirm('Are you sure you want to remove ?') ? document.getElementById('delete-{{ $order->id }}-product').submit() : null">
                                            <span class="glyphicon glyphicon-remove"></span> Remove
                                        </button>
                                    </form>
                                </td> --}} 
                                {{-- <td>
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-info">
                                        Select
                                    </a>
                                </td> --}}
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <ul class="list-group mb-3">
                                        @foreach ($order->cart->products as $product)
                                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                                Name : {{ $product->name }}<br>
                                                Quantity : {{ $product->pivot->quantity }} <br>
                                                Item Price : £{{  number_format($product->pivot->total, 2) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection