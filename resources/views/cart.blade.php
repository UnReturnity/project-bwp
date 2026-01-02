@extends('layout')

@section('content')
<div class="container mt-5">
    <h2>My Shopping Cart</h2>

    @if($cartItems->isEmpty())
        <div class="alert alert-warning">Your cart is empty. <a href="{{ route('home') }}">Go Shop!</a></div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $item->product->image }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                    {{ $item->product->name }}
                                </div>
                            </td>
                            <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <h4>Total: Rp {{ number_format($total, 0, ',', '.') }}</h4>
                <button class="btn btn-success">Checkout Now</button>
            </div>
        </div>
    @endif
</div>
@endsection
