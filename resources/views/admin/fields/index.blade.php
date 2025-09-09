<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn Admin - Manage Fields</title>
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
        .field-card {
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            background: white;
        }
        .field-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .badge-custom {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
        }
        .text-danger {
            color: #dc3545 !important;
        }
        .badge.bg-success {
            background-color: #28a745 !important;
        }
        .badge.bg-warning {
            background-color: #ffc107 !important;
        }
        .badge.bg-danger {
            background-color: #dc3545 !important;
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
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link active" href="{{ route('admin.fields.index') }}">
                            <i class="fas fa-futbol me-2"></i>Manage Fields
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-calendar-alt me-2"></i>Bookings
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-2"></i>Users
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-bar me-2"></i>Reports
                        </a>
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark">Manage Fields</h2>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.fields.create') }}" class="btn btn-custom">
                                <i class="fas fa-plus me-2"></i>Add New Field
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger">
                                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                            </a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($fields->count() > 0)
                        <div class="row">
                            @foreach($fields as $field)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="field-card">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="fw-bold text-dark mb-0">{{ $field->name }}</h5>
                                            <span class="badge 
                                                @if($field->status == 'available') bg-success
                                                @elseif($field->status == 'maintenance') bg-warning
                                                @else bg-danger
                                                @endif">
                                                {{ ucfirst($field->status) }}
                                            </span>
                                        </div>
                                        
                                        <p class="text-muted mb-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $field->location }}
                                        </p>
                                        
                                        <div class="mb-3">
                                            <span class="badge badge-custom me-1">{{ ucfirst($field->sport_type) }}</span>
                                            <span class="badge badge-custom me-1">{{ $field->size }}</span>
                                            <span class="badge badge-custom">{{ ucfirst($field->surface) }}</span>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <strong class="text-danger">৳{{ (int) $field->price_per_90min }}</strong>
                                                <small class="text-muted">/ 90 min</small>
                                            </div>
                                            <div class="text-muted">
                                                <small>{{ \Carbon\Carbon::parse($field->opening_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($field->closing_time)->format('H:i') }}</small>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.fields.show', $field) }}" class="btn btn-outline-danger btn-sm flex-fill">
                                                <i class="fas fa-eye me-1"></i>View
                                            </a>
                                            <a href="{{ route('admin.fields.edit', $field) }}" class="btn btn-outline-danger btn-sm flex-fill">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.fields.destroy', $field) }}" class="d-inline flex-fill">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm w-100" 
                                                        onclick="return confirm('Are you sure you want to delete this field?')">
                                                    <i class="fas fa-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $fields->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-futbol fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">No fields found</h4>
                            <p class="text-muted">Get started by adding your first sports field.</p>
                            <a href="{{ route('admin.fields.create') }}" class="btn btn-custom">
                                <i class="fas fa-plus me-2"></i>Add Your First Field
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
