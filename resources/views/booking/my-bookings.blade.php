<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn - My Bookings</title>
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
        .booking-card {
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            background: white;
        }
        .booking-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .status-confirmed {
            background: #d4edda;
            color: #155724;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        .status-completed {
            background: #d1ecf1;
            color: #0c5460;
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
                        <a class="nav-link active" href="{{ route('booking.my-bookings') }}">
                            <i class="fas fa-list me-2"></i>My Bookings
                        </a>
                        <a class="nav-link" href="{{ route('favorites.index') }}">
                            <i class="fas fa-star me-2"></i>Favorites
                        </a>
                        <a class="nav-link" href="{{ route('notifications.index') }}">
                            <i class="fas fa-bell me-2"></i>Notifications
                            @if($unreadNotifications > 0)
                                <span class="badge bg-danger ms-2">{{ $unreadNotifications }}</span>
                            @endif
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold text-dark">My Bookings</h2>
                        <a href="{{ route('booking.search') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Book New Field
                        </a>
                    </div>

                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Bookings</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('booking.my-bookings') }}" class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Sport Type</label>
                                    <select name="sport" class="form-select">
                                        <option value="">All Sports</option>
                                        @foreach($sports as $sport)
                                            <option value="{{ $sport }}" {{ request('sport') == $sport ? 'selected' : '' }}>
                                                {{ ucfirst($sport) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Field Name</label>
                                    <input type="text" name="field" class="form-control" placeholder="Search field name..." value="{{ request('field') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">From Date</label>
                                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">To Date</label>
                                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">&nbsp;</label>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <a href="{{ route('booking.my-bookings') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($bookings->count() > 0)
                        <div class="row">
                            @foreach($bookings as $booking)
                                <div class="col-12">
                                    <div class="booking-card">
                                        <div class="row align-items-center" data-booking-id="{{ $booking->id }}" data-created-at="{{ $booking->created_at->timestamp }}">
                                            <div class="col-md-8">
                                                <h5 class="fw-bold mb-2">{{ $booking->sportsField->name }}</h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</p>
                                                        <p class="mb-1"><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="mb-1"><strong>Sport:</strong> {{ ucfirst($booking->sportsField->sport_type) }}</p>
                                                        <p class="mb-1"><strong>Location:</strong> {{ $booking->sportsField->location }}</p>
                                                    </div>
                                                </div>
                                                @if($booking->notes)
                                                    <p class="mb-0 mt-2"><strong>Notes:</strong> {{ $booking->notes }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <div class="mb-2 d-flex align-items-center justify-content-end gap-2">
                                                    <span class="status-badge status-{{ $booking->status }}">
                                                        {{ ucfirst($booking->status) }}
                                                    </span>
                                                    <button class="btn btn-sm btn-danger" data-cancel data-disabled-text="Cancel (expired)">Cancel (<span data-timer>60</span>s)</button>
                                                </div>
                                                <h4 class="text-success mb-0">৳{{ (int) $booking->total_price }}</h4>
                                                <small class="text-muted">Total Amount</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">No Bookings Yet</h4>
                            <p class="text-muted">You haven't made any bookings yet. Start by booking your first field!</p>
                            <a href="{{ route('booking.search') }}" class="btn btn-success">
                                <i class="fas fa-calendar-plus me-2"></i>Book Your First Field
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-booking-id]').forEach(card => {
                const createdAt = parseInt(card.getAttribute('data-created-at'), 10) * 1000;
                const cancelBtn = card.querySelector('[data-cancel]');
                const timerSpan = card.querySelector('[data-timer]');
                const bookingId = card.getAttribute('data-booking-id');

                function updateCountdown() {
                    const elapsed = Math.floor((Date.now() - createdAt) / 1000);
                    const remaining = Math.max(0, 60 - elapsed);
                    if (timerSpan) timerSpan.textContent = remaining;
                    if (remaining === 0) {
                        cancelBtn.classList.add('btn-secondary');
                        cancelBtn.classList.remove('btn-danger');
                        cancelBtn.textContent = cancelBtn.getAttribute('data-disabled-text');
                        cancelBtn.disabled = true;
                        clearInterval(intervalId);
                    }
                }

                const intervalId = setInterval(updateCountdown, 1000);
                updateCountdown();

                cancelBtn.addEventListener('click', function() {
                    if (this.disabled) return;
                    fetch(`{{ url('/booking') }}/${bookingId}/cancel`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            // Remove card
                            card.closest('.col-12').remove();
                            // If no cards left, reload to show empty state
                            if (document.querySelectorAll('[data-booking-id]').length === 0) {
                                location.reload();
                            }
                        } else {
                            alert(data.message || 'Unable to cancel booking.');
                        }
                    })
                    .catch(() => alert('Network error.'));
                });
            });
        });
    </script>
</body>
</html>
