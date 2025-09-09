<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn - Notifications</title>
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
        .notification-card {
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            background: white;
        }
        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .notification-card.unread {
            border-left: 4px solid #2d5016;
            background: #f8f9fa;
        }
        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }
        .icon-booking { background: #28a745; }
        .icon-cancelled { background: #dc3545; }
        .icon-price { background: #ffc107; color: #000; }
        .icon-field { background: #17a2b8; }
        
        /* Custom Pagination Styles */
        .pagination {
            justify-content: center;
            margin-top: 30px;
        }
        .pagination .page-link {
            color: #2d5016;
            border: 1px solid #2d5016;
            padding: 8px 12px;
            margin: 0 2px;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .pagination .page-link:hover {
            background-color: #2d5016;
            color: white;
            border-color: #2d5016;
        }
        .pagination .page-item.active .page-link {
            background-color: #2d5016;
            border-color: #2d5016;
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
                <i class="fas fa-futbol me-2"></i>GameOn
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
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
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('booking.search') }}">
                            <i class="fas fa-calendar-alt me-2"></i>Book Field
                        </a>
                        <a class="nav-link" href="{{ route('booking.my-bookings') }}">
                            <i class="fas fa-list me-2"></i>My Bookings
                        </a>
                        <a class="nav-link" href="{{ route('favorites.index') }}">
                            <i class="fas fa-star me-2"></i>Favorites
                        </a>
                        <a class="nav-link active" href="{{ route('notifications.index') }}">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark">Notifications</h2>
                    </div>

                    @if($notifications->count() > 0)
                        @foreach($notifications as $notification)
                            <div class="notification-card {{ !$notification->is_read ? 'unread' : '' }}" data-notification-id="{{ $notification->id }}">
                                <div class="d-flex align-items-start">
                                    <div class="notification-icon icon-{{ str_replace('_', '', explode('_', $notification->type)[0]) }} me-3">
                                        @if($notification->type === 'booking_created')
                                            <i class="fas fa-calendar-check"></i>
                                        @elseif($notification->type === 'booking_cancelled')
                                            <i class="fas fa-calendar-times"></i>
                                        @elseif($notification->type === 'price_changed')
                                            <i class="fas fa-dollar-sign"></i>
                                        @elseif($notification->type === 'field_created')
                                            <i class="fas fa-plus"></i>
                                        @elseif($notification->type === 'field_updated')
                                            <i class="fas fa-edit"></i>
                                        @else
                                            <i class="fas fa-bell"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1">{{ $notification->title }}</h5>
                                        <p class="mb-2 text-muted">{{ $notification->message }}</p>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    @if(!$notification->is_read)
                                        <button class="btn btn-sm btn-outline-primary mark-read-btn" data-notification-id="{{ $notification->id }}">
                                            Mark as Read
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        {{ $notifications->links() }}
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">No Notifications</h4>
                            <p class="text-muted">You don't have any notifications yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.mark-read-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const notificationId = this.getAttribute('data-notification-id');
                    
                    fetch(`/notifications/${notificationId}/mark-read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const card = document.querySelector(`[data-notification-id="${notificationId}"]`);
                            card.classList.remove('unread');
                            this.remove();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
        });
    </script>
</body>
</html>