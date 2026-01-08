@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-success">+ Add New Product</a>
    </div>

    <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="🔍 Search products (Type to filter instantly)...">
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="product-table-body">
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <img src="{{ str_contains($product->image, 'http') ? $product->image : asset($product->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#search').on('keyup', function(){
            var query = $(this).val();
            $.ajax({
                url: "{{ route('admin.search') }}",
                type: "GET",
                data: {'query': query},
                success: function(data){
                    $('#product-table-body').html(data.html);
                }
            });
        });
    });
</script>
@endsection
