@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table bg-white table-striped">
                    <thead>
                        <h2>Make Changes</h2>
                    </thead>
                    <tbody>
                    @if(auth()->user()->role == 'admin')
                    <form class="row g-3" method="POST" action="{{ route('orders.update', $order->id) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        
                        
                        <div class="row pt-3">
                            <div class="col-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status">
                                    @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $value)
                                        <option value="{{ $value }}" {{ old('status', $order->status) == $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            
                                <div id="Help" class="form-text">Edit Status</div>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="payment_status" class="form-label">Payment Status</label>
                                <select class="form-control @error('payment_status') is-invalid @enderror" id="payment_status"
                                name="payment_status">
                                    @foreach (['pending', 'paid', 'failed'] as $value)
                                        <option value="{{ $value }}" {{ old('status', $order->payment_status) == $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <div id="Help" class="form-text">Edit Payment Status</div>
                                @error('payment_status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- @elseif (auth()->user()->role == 'admin' || auth()->user()->role == 'customer') --}}
                            <div class="col-6">
                                <label for="method" class="form-label">Method</label>
                                <select class="form-control @error('method') is-invalid @enderror" id="method"
                                name="method">
                                    @foreach (['collection', 'delivery'] as $value)
                                        <option value="{{ $value }}" {{ old('method', $order->method) == $value ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            
                                <div id="Help" class="form-text">Edit Order Collection or Delivery</div>
                                @error('method')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        {{-- @endif --}}
                        </form>
                        @endif
                        @if(auth()->user()->role == 'customer')
                        <form class="row g-3" method="POST" action="{{ route('orders.update', $order->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            {{-- @if(auth()->user()->role == 'customer') --}}
                            <div class="row pt-3">
                                <div class="col-6">
                                    <label for="method" class="form-label">Method</label>
                                    <select class="form-control @error('method') is-invalid @enderror" id="method"
                                    name="method">
                                        @foreach (['collection', 'delivery'] as $value)
                                            <option value="{{ $value }}" {{ old('method', $order->method) == $value ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                
                                    <div id="Help" class="form-text">Edit Order Collection or Delivery</div>
                                    @error('method')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            {{-- @endif --}}
                            </form>
                            @endif
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
@endsection