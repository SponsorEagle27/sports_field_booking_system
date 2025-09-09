<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn Admin - Add New Field</title>
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
        .main-content {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            padding: 30px;
            margin-top: 2rem;
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
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .form-select:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
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

    <div class="container">
        <div class="main-content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark">Add New Field</h2>
                <a href="{{ route('admin.fields.index') }}" class="btn btn-outline-danger">
                    <i class="fas fa-arrow-left me-2"></i>Back to Fields
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.fields.store') }}">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Field Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sport_type" class="form-label">Sport Type</label>
                            <select class="form-select" id="sport_type" name="sport_type" required>
                                <option value="">Select Sport Type</option>
                                <option value="football" {{ old('sport_type') == 'football' ? 'selected' : '' }}>Football</option>
                                <option value="basketball" {{ old('sport_type') == 'basketball' ? 'selected' : '' }}>Basketball</option>
                                <option value="tabletennis" {{ old('sport_type') == 'tabletennis' ? 'selected' : '' }}>Table Tennis</option>
                                <option value="cricket" {{ old('sport_type') == 'cricket' ? 'selected' : '' }}>Cricket</option>
                                <option value="badminton" {{ old('sport_type') == 'badminton' ? 'selected' : '' }}>Badminton</option>
                                <option value="paddle" {{ old('sport_type') == 'paddle' ? 'selected' : '' }}>Paddle</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">Field Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="size" class="form-label">Size</label>
                            <select class="form-select" id="size" name="size" required>
                                <option value="">Select Size</option>
                                <option value="Full Size" {{ old('size') == 'Full Size' ? 'selected' : '' }}>Full Size</option>
                                <option value="11-a-side" {{ old('size') == '11-a-side' ? 'selected' : '' }}>11-a-side</option>
                                <option value="7-a-side" {{ old('size') == '7-a-side' ? 'selected' : '' }}>7-a-side</option>
                                <option value="5-a-side" {{ old('size') == '5-a-side' ? 'selected' : '' }}>5-a-side</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="surface" class="form-label">Surface</label>
                            <select class="form-select" id="surface" name="surface" required>
                                <option value="">Select Surface</option>
                                <option value="Grass" {{ old('surface') == 'Grass' ? 'selected' : '' }}>Grass</option>
                                <option value="Artificial Turf" {{ old('surface') == 'Artificial Turf' ? 'selected' : '' }}>Artificial Turf</option>
                                <option value="Indoor Court" {{ old('surface') == 'Indoor Court' ? 'selected' : '' }}>Indoor Court</option>
                                <option value="Outdoor Court" {{ old('surface') == 'Outdoor Court' ? 'selected' : '' }}>Outdoor Court</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price_per_90min" class="form-label">Price per 90 minutes (৳)</label>
                            <input type="number" class="form-control" id="price_per_90min" name="price_per_90min" 
                                   value="{{ old('price_per_90min') }}" min="0" step="1" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="opening_time" class="form-label">Opening Time</label>
                            <input type="time" class="form-control" id="opening_time" name="opening_time" 
                                   value="{{ old('opening_time') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="closing_time" class="form-label">Closing Time</label>
                            <input type="time" class="form-control" id="closing_time" name="closing_time" 
                                   value="{{ old('closing_time') }}" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-custom">
                        <i class="fas fa-save me-2"></i>Create Field
                    </button>
                    <a href="{{ route('admin.fields.index') }}" class="btn btn-outline-danger">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
