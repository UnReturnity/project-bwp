@extends('layout')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <h3 class="text-center">Register</h3>
        <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control">
            </div>
            <button class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</div>
@endsection
