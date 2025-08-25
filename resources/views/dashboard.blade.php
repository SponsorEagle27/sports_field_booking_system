<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c59 100%);
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
            color: #2d5016;
        }
        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c59 100%);
            color: white;
        }
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c59 100%);
            color: white;
        }
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 30px;
        }
        .stats-card {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c59 100%);
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
            background: linear-gradient(135deg, #2d5016 0%, #4a7c59 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 80, 22, 0.4);
            color: white;
        }
        .btn-outline-primary {
            border-color: #2d5016;
            color: #2d5016;
        }
        .btn-outline-primary:hover {
            background-color: #2d5016;
            border-color: #2d5016;
            color: white;
        }
        .btn-outline-success {
            border-color: #4a7c59;
            color: #4a7c59;
        }
        .btn-outline-success:hover {
            background-color: #4a7c59;
            border-color: #4a7c59;
            color: white;
        }
        .btn-outline-info {
            border-color: #6b8e5a;
            color: #6b8e5a;
        }
        .btn-outline-info:hover {
            background-color: #6b8e5a;
            border-color: #6b8e5a;
            color: white;
        }
        .text-primary {
            color: #2d5016 !important;
        }
        .badge.bg-success {
            background-color: #4a7c59 !important;
        }
        .badge.bg-warning {
            background-color: #8f9a3c !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-futbol me-2"></i>GameOn
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('booking.search') }}">
                            <i class="fas fa-search me-1"></i>Search Fields
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
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
                    <h5 class="mb-3 fw-bold text-dark">Menu</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('booking.search') }}">
                            <i class="fas fa-calendar-alt me-2"></i>Book Field
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-list me-2"></i>My Bookings
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-history me-2"></i>Booking History
                        </a>
                        <a class="nav-link" href="{{ route('favorites.index') }}">
                            <i class="fas fa-star me-2"></i>Favorites
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark">Welcome back, {{ Auth::user()->name }}!</h2>
                        <a href="{{ route('booking.search') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-2"></i>New Booking
                        </a>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $activeBookings }}</h3>
                                        <p class="mb-0">Active Bookings</p>
                                    </div>
                                    <i class="fas fa-calendar-check fa-2x"></i>
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
                                    <i class="fas fa-list-alt fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>{{ $favoriteFields }}</h3>
                                        <p class="mb-0">Favorite Fields</p>
                                    </div>
                                    <i class="fas fa-heart fa-2x"></i>
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
                                                <th>Field</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentBookings as $booking)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-futbol text-primary me-2"></i>
                                                            <div>
                                                                <strong>{{ $booking->sportsField->name ?? 'Unknown Field' }}</strong>
                                                                <br><small class="text-muted">{{ $booking->sportsField->type ?? 'Unknown Type' }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
                                                    <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                                                    <td>
                                                        @if($booking->status == 'confirmed')
                                                            <span class="badge bg-success">Confirmed</span>
                                                        @elseif($booking->status == 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @else
                                                            <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary">View</button>
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
                                    <p class="text-muted">Start by booking your first sports field!</p>
                                    <a href="{{ route('booking.search') }}" class="btn btn-custom">
                                        <i class="fas fa-plus me-2"></i>Book Your First Field
                                    </a>
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
                                    <button class="btn btn-custom w-100">
                                        <i class="fas fa-calendar-plus me-2"></i>Book Field
                                    </button>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-outline-primary w-100">
                                        <i class="fas fa-search me-2"></i>Find Fields
                                    </button>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-outline-success w-100">
                                        <i class="fas fa-star me-2"></i>Favorites
                                    </button>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-outline-info w-100">
                                        <i class="fas fa-bell me-2"></i>Notifications
                                    </button>
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