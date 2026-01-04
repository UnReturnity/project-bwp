@extends('layout')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">Edit Product</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <img src="{{ asset($product->image) }}" width="100" class="mb-2 rounded border">
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-warning">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
