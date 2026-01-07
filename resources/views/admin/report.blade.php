@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📊 Financial & Transaction Report</h2>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body bg-light">
            <form action="{{ route('admin.report') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">🔍 Filter Data</button>
                    <a href="{{ route('admin.report') }}" class="btn btn-outline-secondary w-100 mt-2">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-header">Total Sales (Income)</div>
                <div class="card-body">
                    <h3 class="card-title">+ Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-header">Total Expenses</div>
                <div class="card-body">
                    <h3 class="card-title">- Rp {{ number_format($totalExpenses, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white {{ $profit >= 0 ? 'bg-primary' : 'bg-warning' }} mb-3 shadow">
                <div class="card-header">Net Profit</div>
                <div class="card-body">
                    <h3 class="card-title">Rp {{ number_format($profit, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-danger text-white">Add New Expense</div>
                <div class="card-body">
                    <form action="{{ route('admin.expense.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" placeholder="e.g. Flour" required>
                        </div>
                        <div class="mb-2">
                            <label>Amount (Rp)</label>
                            <input type="number" name="amount" class="form-control" placeholder="e.g. 50000" required>
                        </div>
                        <div class="mb-2">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 mt-2">Add Expense</button>
                    </form>
                </div>
            </div>

            <h5 class="text-danger">Expense History</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead><tr><th>Date</th><th>Desc</th><th>Amount</th></tr></thead>
                    <tbody>
                        @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->date }}</td>
                            <td>{{ $expense->description }}</td>
                            <td>Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-7">
            <h5 class="text-success">✅ Transaction History (Sales)</h5>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-success">
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $t)
                        <tr>
                            <td>{{ $t->transaction_date }}</td>
                            <td>{{ $t->user->name ?? 'Unknown' }}</td>
                            <td>{{ $t->details->count() }} Items</td>
                            <td class="fw-bold">Rp {{ number_format($t->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No sales found for this period.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
