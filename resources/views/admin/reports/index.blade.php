<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn - Admin Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .admin-theme {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
    .btn-custom {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-custom:hover {
        background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }
    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .stat-card {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        border-radius: 15px;
    }
    .stat-card .card-body {
        padding: 1.5rem;
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    .chart-container {
        height: 300px;
        position: relative;
    }
    .table th {
        background-color: #f8f9fa;
        border-top: none;
        font-weight: 600;
    }
    .pagination .page-link {
        color: #dc3545;
        border-color: #dc3545;
    }
    .pagination .page-item.active .page-link {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    .pagination .page-link:hover {
        color: white;
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark admin-theme">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-chart-line me-2"></i>Admin Reports
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.fields.index') }}">
                        <i class="fas fa-map-marker-alt me-1"></i>Fields
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.bookings.index') }}">
                        <i class="fas fa-calendar-check me-1"></i>Bookings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users me-1"></i>Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.settings.pricing') }}">
                        <i class="fas fa-cog me-1"></i>Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.reports.index') }}">
                        <i class="fas fa-chart-bar me-1"></i>Reports
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white p-0">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="main-content">
        <!-- Date Range Filter -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Report Period</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">From Date</label>
                        <input type="date" name="date_from" class="form-control" value="{{ $dateFrom }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">To Date</label>
                        <input type="date" name="date_to" class="form-control" value="{{ $dateTo }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-custom">
                                <i class="fas fa-search me-1"></i>Generate Report
                            </button>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-danger">
                                <i class="fas fa-refresh me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Key Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body text-center">
                        <div class="stat-number">{{ $totalBookings }}</div>
                        <div class="stat-label">Total Bookings</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body text-center">
                        <div class="stat-number">{{ $confirmedBookings }}</div>
                        <div class="stat-label">Confirmed</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body text-center">
                        <div class="stat-number">{{ $pendingBookings }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card">
                    <div class="card-body text-center">
                        <div class="stat-number">৳{{ number_format($totalIncome) }}</div>
                        <div class="stat-label">Total Income</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Income Breakdown -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Income Breakdown</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="text-center">
                                    <h4 class="text-success">৳{{ number_format($cashIncome) }}</h4>
                                    <small class="text-muted">Cash Payments</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <h4 class="text-info">৳{{ number_format($bkashIncome) }}</h4>
                                    <small class="text-muted">bKash Payments</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Payment Methods</h5>
                    </div>
                    <div class="card-body">
                        @foreach($paymentStats as $payment)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-capitalize">{{ $payment->payment_method ?? 'Unknown' }}</span>
                                <div>
                                    <span class="badge bg-primary me-2">{{ $payment->count }} bookings</span>
                                    <span class="fw-bold">৳{{ number_format($payment->total) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Sport-wise Statistics -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-futbol me-2"></i>Bookings by Sport</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Sport</th>
                                        <th>Bookings</th>
                                        <th>Income</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sportStats as $sport)
                                        <tr>
                                            <td class="text-capitalize">{{ $sport->sport_type }}</td>
                                            <td><span class="badge bg-primary">{{ $sport->booking_count }}</span></td>
                                            <td>৳{{ number_format($sport->total_income) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-star me-2"></i>Most Popular Fields</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Sport</th>
                                        <th>Bookings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popularFields as $field)
                                        <tr>
                                            <td>{{ $field->name }}</td>
                                            <td><span class="badge bg-secondary text-capitalize">{{ $field->sport_type }}</span></td>
                                            <td><span class="badge bg-success">{{ $field->booking_count }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Slot Analysis -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Most Used Time Slots</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Time Slot</th>
                                        <th>Bookings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($popularSlots as $slot)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($slot->slot_time)->format('g:i A') }}</td>
                                            <td><span class="badge bg-info">{{ $slot->booking_count }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Peak Hours</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Hour</th>
                                        <th>Bookings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hourlyStats as $hour)
                                        <tr>
                                            <td>{{ $hour->hour }}:00 - {{ $hour->hour + 1 }}:00</td>
                                            <td><span class="badge bg-warning">{{ $hour->booking_count }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>Recent Bookings</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Field</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $booking)
                                <tr>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->sportsField->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</td>
                                    <td>৳{{ number_format($booking->total_price) }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ strtoupper($booking->payment_method ?? '-') }}</span>
                                        <span class="badge bg-{{ ($booking->payment_status === 'paid') ? 'success' : 'warning' }} ms-1">{{ ucfirst($booking->payment_status ?? 'pending') }}</span>
                                    </td>
                                    <td>
                                        @if($booking->status == 'confirmed')
                                            <span class="badge bg-success">Confirmed</span>
                                        @elseif($booking->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>