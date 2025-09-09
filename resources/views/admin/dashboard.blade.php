<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            color: #ffffff !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        .sidebar {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 20px;
            height: fit-content;
        }
        .sidebar .nav-link {
            border-radius: 10px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            color: #dc3545;
        }
        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 30px;
        }
        .stats-card {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .stats-card h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .btn-custom {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
            color: white;
        }
        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .text-danger {
            color: #dc3545 !important;
        }
        .badge.bg-danger {
            background-color: #dc3545 !important;
        }
        .badge.bg-warning {
            background-color: #ffc107 !important;
        }
        .badge.bg-success {
            background-color: #28a745 !important;
        }
        
        /* Custom Pagination Styles */
        .pagination {
            justify-content: center;
            margin-top: 30px;
        }
        .pagination .page-link {
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 8px 12px;
            margin: 0 2px;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .pagination .page-link:hover {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }
        .pagination .page-item.active .page-link {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            border-color: #dee2e6;
            background-color: #fff;
        }
        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-futbol me-2"></i>GameOn Admin
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-shield me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar">
                    <h5 class="mb-3 fw-bold text-dark">Admin Menu</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('admin.fields.index') }}">
                            <i class="fas fa-futbol me-2"></i>Manage Fields
                        </a>
                        <a class="nav-link" href="{{ route('admin.bookings.index') }}">
                            <i class="fas fa-calendar-alt me-2"></i>Bookings
                        </a>
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users me-2"></i>Users
                        </a>
                        <a class="nav-link" href="{{ route('admin.reports.index') }}">
                            <i class="fas fa-chart-bar me-2"></i>Reports
                        </a>
                        <a class="nav-link" href="{{ route('admin.settings.pricing') }}">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark">Admin Dashboard</h2>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.fields.create') }}" class="btn btn-custom">
                                <i class="fas fa-plus me-2"></i>Add Field
                            </a>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $totalFields }}</h3>
                                        <p class="mb-0">Total Fields</p>
                                    </div>
                                    <i class="fas fa-futbol fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $totalBookings }}</h3>
                                        <p class="mb-0">Total Bookings</p>
                                    </div>
                                    <i class="fas fa-calendar-check fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $totalUsers }}</h3>
                                        <p class="mb-0">Total Users</p>
                                    </div>
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Bookings -->
                    <div class="row">
                        <div class="col-12">
                            <h4 class="fw-bold mb-3">Recent Bookings</h4>
                            @if($recentBookings->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>User</th>
                                                <th>Field</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Payment</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentBookings as $booking)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-user text-danger me-2"></i>
                                                            <div>
                                                                <strong>{{ $booking->user->name ?? 'Unknown User' }}</strong>
                                                                <br><small class="text-muted">{{ $booking->user->email ?? 'No email' }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-futbol text-danger me-2"></i>
                                                            <div>
                                                                <strong>{{ $booking->sportsField->name ?? 'Unknown Field' }}</strong>
                                                                <br><small class="text-muted">{{ $booking->sportsField->sport_type ?? 'Unknown Type' }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</td>
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
                                                            <span class="badge bg-danger">{{ ucfirst($booking->status) }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No bookings yet</h5>
                                    <p class="text-muted">Bookings will appear here once users start booking fields.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="fw-bold mb-3">Quick Actions</h4>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.fields.create') }}" class="btn btn-custom w-100">
                                        <i class="fas fa-plus me-2"></i>Add Field
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.fields.index') }}" class="btn btn-outline-danger w-100">
                                        <i class="fas fa-futbol me-2"></i>Manage Fields
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-danger w-100">
                                        <i class="fas fa-calendar-alt me-2"></i>View Bookings
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-danger w-100">
                                        <i class="fas fa-chart-bar me-2"></i>Reports
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
