@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">📜 My Order History</h2>

    @if($transactions->isEmpty())
        <div class="alert alert-info">
            You haven't bought anything yet! <a href="{{ route('home') }}">Go buy some bread.</a>
        </div>
    @else
        <div class="row">
            @foreach($transactions as $transaction)
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                            <span>
                                <strong>Order Date:</strong> {{ $transaction->transaction_date }}
                            </span>
                            <span class="badge bg-warning text-dark">
                                Total: Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Items Purchased:</h6>
                            <ul class="list-group list-group-flush">
                                @foreach($transaction->details as $detail)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $detail->product->name }}</strong>
                                            <span class="text-muted">x {{ $detail->quantity }}</span>
                                        </div>
                                        <span>Rp {{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
