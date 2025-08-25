<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn - {{ $field->name }}</title>
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
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 30px;
            margin-top: 2rem;
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
        .field-header {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c59 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .field-price {
            font-size: 2.5rem;
            font-weight: bold;
            color:rgb(193, 216, 178);
        }
        .info-card {
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            background: white;
        }
        .badge-custom {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c59 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .text-primary {
            color: #2d5016 !important;
        }
        
        .favorite-btn {
            background: #dc3545;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            color: white;
            transition: all 0.3s ease;
            width: 100%;
        }
        .favorite-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
        .favorite-btn.not-favorited {
            background: #6c757d;
        }
        .favorite-btn.not-favorited:hover {
            background: #dc3545;
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

    <div class="container">
        <div class="main-content">
            <!-- Field Header -->
            <div class="field-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="fw-bold mb-2">{{ $field->name }}</h1>
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>{{ $field->location }}
                        </p>
                        <p class="mb-0">{{ $field->address }}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="field-price">৳{{ $field->price_per_90min }}</div>
                        <p class="mb-0">per 90 minutes</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Field Information -->
                <div class="col-lg-8">
                    <div class="info-card">
                        <h4 class="fw-bold mb-3">
                            <i class="fas fa-info-circle me-2"></i>Field Information
                        </h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Sport Type:</strong>
                                <span class="badge badge-custom ms-2">{{ ucfirst($field->sport_type) }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Size:</strong>
                                <span class="badge badge-custom ms-2">{{ $field->size }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Surface:</strong>
                                <span class="badge badge-custom ms-2">{{ ucfirst($field->surface) }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Type:</strong>
                                <span class="badge badge-custom ms-2">{{ ucfirst($field->type) }}</span>
                            </div>
                        </div>
                        @if($field->description)
                            <hr>
                            <p class="mb-0">{{ $field->description }}</p>
                        @endif
                    </div>

                    <div class="info-card">
                        <h4 class="fw-bold mb-3">
                            <i class="fas fa-clock me-2"></i>Operating Hours
                        </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Opening Time:</strong>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($field->opening_time)->format('g:i A') }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Closing Time:</strong>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($field->closing_time)->format('g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Section -->
                <div class="col-lg-4">
                    <div class="info-card">
                        <h4 class="fw-bold mb-3">
                            <i class="fas fa-calendar-plus me-2"></i>Book This Field
                        </h4>
                        <p class="text-muted mb-3">Select your preferred date and time to book this field.</p>
                        
                        <form>
                            <div class="mb-3">
                                <label for="booking_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="booking_date" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="start_time" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="duration" class="form-label">Duration</label>
                                <select class="form-select" id="duration" required>
                                    <option value="90">90 minutes</option>
                                    <option value="180">3 hours</option>
                                    <option value="270">4.5 hours</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-custom w-100">
                                <i class="fas fa-calendar-check me-2"></i>Book Now
                            </button>
                        </form>
                    </div>

                    <div class="info-card">
                        <h5 class="fw-bold mb-3">Quick Actions</h5>
                        <div class="d-grid gap-2">
                            <a href="{{ route('booking.search') }}" class="btn btn-outline-primary">
                                <i class="fas fa-search me-2"></i>Search More Fields
                            </a>
                            <button class="favorite-btn" id="favorite-{{ $field->id }}" onclick="toggleFavorite({{ $field->id }}, this)">
                                <i class="fas fa-heart me-2"></i><span id="favorite-text-{{ $field->id }}">Add to Favorites</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Check favorite status when page loads
        document.addEventListener('DOMContentLoaded', function() {
            checkFavoriteStatus({{ $field->id }}, document.getElementById('favorite-{{ $field->id }}'));
        });
        
        function toggleFavorite(fieldId, button) {
            fetch('{{ route("favorites.toggle") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    sports_field_id: fieldId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.isFavorited) {
                        // Field was added to favorites
                        button.classList.remove('not-favorited');
                        button.style.background = '#dc3545';
                        document.getElementById(`favorite-text-${fieldId}`).textContent = 'Remove from Favorites';
                    } else {
                        // Field was removed from favorites
                        button.classList.add('not-favorited');
                        button.style.background = '#6c757d';
                        document.getElementById(`favorite-text-${fieldId}`).textContent = 'Add to Favorites';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating favorites.');
            });
        }
        
        function checkFavoriteStatus(fieldId, button) {
            fetch('{{ route("favorites.check-status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    sports_field_id: fieldId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.isFavorited) {
                        button.classList.remove('not-favorited');
                        button.style.background = '#dc3545';
                        document.getElementById(`favorite-text-${fieldId}`).textContent = 'Remove from Favorites';
                    } else {
                        button.classList.add('not-favorited');
                        button.style.background = '#6c757d';
                        document.getElementById(`favorite-text-${fieldId}`).textContent = 'Add to Favorites';
                    }
                }
            })
            .catch(error => {
                console.error('Error checking favorite status:', error);
            });
        }
    </script>
</body>
</html> 