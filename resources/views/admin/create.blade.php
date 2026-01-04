@extends('layout')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">Add New Product</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Chocolate Croissant">
                </div>

                <div class="mb-3">
                    <label class="form-label">Price (Rp)</label>
                    <input type="number" name="price" class="form-control" required placeholder="e.g. 25000">
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control" required accept="image/*">
                    <small class="text-muted">Upload a JPG or PNG from your computer.</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
