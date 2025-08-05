<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - GameOn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 25%, #0d4d0d 50%, #1a1a1a 75%, #0a0a0a 100%);
            min-height: 100vh;
            color: #ffffff;
            overflow-x: hidden;
        }
        
        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        .bg-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(0, 255, 65, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 255, 65, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: float 8s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-15px) rotate(0.5deg); }
            66% { transform: translateY(10px) rotate(-0.5deg); }
        }
        
        .navbar {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 255, 65, 0.3);
            box-shadow: 0 2px 20px rgba(0, 255, 65, 0.1);
        }
        
        .navbar-brand {
            color: #00ff41 !important;
            font-weight: 800;
            text-shadow: 0 0 10px rgba(0, 255, 65, 0.5);
        }
        
        .sidebar {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 255, 65, 0.1);
            border: 1px solid rgba(0, 255, 65, 0.2);
            padding: 20px;
            height: fit-content;
        }
        
        .sidebar .nav-link {
            border-radius: 10px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.8);
            border: 1px solid transparent;
        }
        
        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, #00ff41, #00cc33);
            color: #000000;
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 255, 65, 0.3);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #00ff41, #00cc33);
            color: #000000;
            border-color: rgba(255, 255, 255, 0.3);
        }
        
        .main-content {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 255, 65, 0.1);
            border: 1px solid rgba(0, 255, 65, 0.2);
            padding: 30px;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #00ff41, #00cc33);
            color: #000000;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 25px rgba(0, 255, 65, 0.2);
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 255, 65, 0.3);
        }
        
        .stats-card h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #00ff41, #00cc33);
            border: none;
            border-radius: 10px;
            color: #000000;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 255, 65, 0.4);
            color: #000000;
            background: linear-gradient(135deg, #00cc33, #00ff41);
        }
        
        .btn-outline-custom {
            background: transparent;
            border: 2px solid #00ff41;
            border-radius: 10px;
            color: #00ff41;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background: #00ff41;
            color: #000000;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 255, 65, 0.3);
        }
        
        .table {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: rgba(0, 255, 65, 0.2);
            color: #00ff41;
            border: none;
            font-weight: 600;
        }
        
        .table tbody tr {
            color: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(0, 255, 65, 0.1);
        }
        
        .table tbody tr:hover {
            background: rgba(0, 255, 65, 0.1);
        }
        
        .badge {
            font-weight: 500;
        }
        
        .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        
        .dropdown-menu {
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 65, 0.3);
        }
        
        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
        }
        
        .dropdown-item:hover {
            background: rgba(0, 255, 65, 0.2);
            color: #00ff41;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }
        
        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-animation"></div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-futbol me-2"></i>GameOn
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
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
                <div class="sidebar animate-fade-in">
                    <h5 class="mb-3 fw-bold text-white">Menu</h5>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('booking') }}">
                            <i class="fas fa-calendar-alt me-2"></i>Book Field
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-list me-2"></i>My Bookings
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-history me-2"></i>Booking History
                        </a>
                        <a class="nav-link" href="#">
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
                <div class="main-content animate-fade-in animate-delay-1">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-white">Welcome back, {{ Auth::user()->name }}!</h2>
                        <a href="{{ route('booking') }}" class="btn btn-custom">
                            <i class="fas fa-plus me-2"></i>New Booking
                        </a>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="stats-card animate-fade-in animate-delay-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>5</h3>
                                        <p class="mb-0">Active Bookings</p>
                                    </div>
                                    <i class="fas fa-calendar-check fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card animate-fade-in animate-delay-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>12</h3>
                                        <p class="mb-0">Total Bookings</p>
                                    </div>
                                    <i class="fas fa-list-alt fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stats-card animate-fade-in animate-delay-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h3>3</h3>
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
                            <h4 class="fw-bold mb-3 text-white">Recent Bookings</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Field</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-futbol text-success me-2"></i>
                                                    <div>
                                                        <strong>Football Field 1</strong>
                                                        <br><small class="text-muted">Outdoor</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Dec 15, 2024</td>
                                            <td>14:00 - 16:00</td>
                                            <td><span class="badge bg-success">Confirmed</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-custom">View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-basketball-ball text-warning me-2"></i>
                                                    <div>
                                                        <strong>Basketball Court</strong>
                                                        <br><small class="text-muted">Indoor</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Dec 16, 2024</td>
                                            <td>18:00 - 20:00</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-custom">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="fw-bold mb-3 text-white">Quick Actions</h4>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('booking') }}" class="btn btn-custom w-100">
                                        <i class="fas fa-calendar-plus me-2"></i>Book Field
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-outline-custom w-100">
                                        <i class="fas fa-search me-2"></i>Find Fields
                                    </button>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-outline-custom w-100">
                                        <i class="fas fa-star me-2"></i>Favorites
                                    </button>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <button class="btn btn-outline-custom w-100">
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