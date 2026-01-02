@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Our Fresh Menu</h2>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted small">{{ $product->description }}</p>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</span>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
