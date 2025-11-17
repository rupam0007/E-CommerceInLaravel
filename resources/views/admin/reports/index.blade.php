@extends('layouts.admin')

@section('title', 'Admin Reports')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Reports</h1>
        <form method="GET" class="d-flex align-items-center gap-2">
            <label for="period" class="form-label mb-0 me-1">Period:</label>
            <select id="period" name="period" class="form-select w-auto">
                @foreach([7, 14, 30, 60, 90, 180, 365] as $p)
                <option value="{{ $p }}" @selected((string)$period === (string)$p)>{{ $p }} days</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary" style="background-color: var(--accent-color); border-color: var(--accent-color);">Apply</button>
        </form>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Revenue</div>
                    <div class="h5 mb-0 font-weight-bold">₹{{ number_format($salesData['total_revenue'] ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total Orders</div>
                    <div class="h5 mb-0 font-weight-bold">{{ $salesData['total_orders'] ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Avg Order Value</div>
                    <div class="h5 mb-0 font-weight-bold">₹{{ number_format($salesData['avg_order_value'] ?? 0, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">New Customers</div>
                    <div class="h5 mb-0 font-weight-bold">{{ $newCustomers ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">Top Selling Products</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead style="background-color: var(--hover-bg);">
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topProducts as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                                    <td>{{ $item->product->category->name ?? '-' }}</td>
                                    <td>{{ $item->total_sold ?? 0 }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">No data for selected period.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">Order Status Distribution</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover mb-0">
                            <thead style="background-color: var(--hover-bg);">
                                <tr>
                                    <th>Status</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orderStatusData as $row)
                                <tr>
                                    <td>{{ ucfirst($row->status) }}</td>
                                    <td>{{ $row->count }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4">No data for selected period.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Daily Revenue</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0">
                    <thead style="background-color: var(--hover-bg);">
                        <tr>
                            <th>Date</th>
                            <th>Orders</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dailyRevenue as $day)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($day->date)->format('d M Y') }}</td>
                            <td>{{ $day->orders }}</td>
                            <td>₹{{ number_format($day->revenue, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">No data for selected period.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection