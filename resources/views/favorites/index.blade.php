<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn - My Favorites</title>
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
        .field-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2d5016;
        }
        .field-location {
            color: #6c757d;
            font-size: 0.9rem;
        }
        .field-amenities {
            margin-top: 10px;
        }
        .badge-custom {
            background: linear-gradient(135deg, #2d5016 0%, #4a7c59 100%);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
        }
        .favorite-btn {
            background: #dc3545;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            margin-left: 10px;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        }
        .favorite-btn:hover {
            background: #c82333;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
        }
        .favorite-btn.not-favorited {
            background: #6c757d;
            box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
        }
        .favorite-btn.not-favorited:hover {
            background: #dc3545;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
        }
        .no-favorites {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .no-favorites i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #dee2e6;
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">
                    <i class="fas fa-star me-2 text-warning"></i>My Favorite Fields
                </h2>
                <a href="{{ route('booking.search') }}" class="btn btn-custom">
                    <i class="fas fa-search me-2"></i>Find More Fields
                </a>
            </div>

            @if($favorites->count() > 0)
                <div class="row">
                    @foreach($favorites as $field)
                        <div class="col-12">
                            <div class="field-card">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="fw-bold mb-2">{{ $field->name }}</h4>
                                        <p class="field-location mb-2">
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $field->location }}
                                        </p>
                                        <p class="mb-2">{{ $field->address }}</p>
                                        <div class="field-amenities">
                                            <span class="badge badge-custom me-2">{{ $field->sport_type }}</span>
                                            <span class="badge badge-custom me-2">{{ $field->size }}</span>
                                            <span class="badge badge-custom me-2">{{ $field->surface }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="field-price mb-2">৳{{ (int) $field->price_per_90min }}</div>
                                        <p class="text-muted mb-2">per 90 minutes</p>
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('booking.field-details', $field->id) }}" class="btn btn-custom">
                                                <i class="fas fa-eye me-2"></i>View Details
                                            </a>
                                            <button class="favorite-btn" onclick="toggleFavorite({{ $field->id }}, this)" data-field-id="{{ $field->id }}" title="Remove from Favorites">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-favorites">
                    <i class="fas fa-star"></i>
                    <h4 class="mb-3">No Favorite Fields Yet</h4>
                    <p class="mb-4">You haven't added any fields to your favorites yet. Start exploring and add your favorite sports fields!</p>
                    <a href="{{ route('booking.search') }}" class="btn btn-custom btn-lg">
                        <i class="fas fa-search me-2"></i>Explore Fields
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
                    } else {
                        // Field was removed from favorites
                        button.classList.add('not-favorited');
                        button.style.background = '#6c757d';
                        // Remove the field card from the page
                        button.closest('.field-card').remove();
                        
                        // Check if there are no more favorites
                        const remainingCards = document.querySelectorAll('.field-card');
                        if (remainingCards.length === 0) {
                            location.reload(); // Reload to show "no favorites" message
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating favorites.');
            });
        }
    </script>
</body>
</html> 