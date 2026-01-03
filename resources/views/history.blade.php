@extends('layout')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">My Order History</h2>

    @if($transactions->isEmpty())
        <div class="alert alert-info">You haven't bought anything yet. <a href="{{ route('home') }}">Go buy some bread!</a></div>
    @else
        <div class="accordion" id="transactionAccordion">
            @foreach($transactions as $transaction)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $transaction->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $transaction->id }}">
                        Order #{{ $transaction->id }} - {{ $transaction->transaction_date }}
                    </button>
                </h2>
                <div id="collapse{{ $transaction->id }}" class="accordion-collapse collapse" data-bs-parent="#transactionAccordion">
                    <div class="accordion-body">
                        <ul class="list-group">
                            @foreach($transaction->details as $detail)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $detail->product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $detail->quantity }} x Rp {{ number_format($detail->product->price, 0, ',', '.') }}</small>
                                </div>
                                <span>Rp {{ number_format($detail->quantity * $detail->product->price, 0, ',', '.') }}</span>
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
