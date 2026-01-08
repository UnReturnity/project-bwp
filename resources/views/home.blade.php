@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold">🍞 Fresh from the Oven</h1>
            <p class="text-muted">Delicious pastries baked with love every morning.</p>
        </div>
    </div>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <img src="{{ str_contains($product->image, 'http') ? $product->image : asset($product->image) }}"
                     class="card-img-top"
                     alt="{{ $product->name }}"
                     style="height: 200px; object-fit: cover;">

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                    <p class="card-text text-primary fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <div class="mt-auto">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning w-100 fw-bold">
                                🛒 Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
