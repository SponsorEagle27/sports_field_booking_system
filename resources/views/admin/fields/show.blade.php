<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn Admin - Field Details</title>
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
        .field-header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
        }
        .info-card {
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            background: white;
        }
        .badge-custom {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .time-slots-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 15px;
        }
        .time-slot {
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            text-align: center;
            background: white;
            transition: all 0.3s ease;
        }
        .time-slot.available {
            border-color: #28a745;
            background: #f8fff9;
        }
        .time-slot.unavailable {
            border-color: #dc3545;
            background: #fff8f8;
        }
        .form-check-input:checked {
            background-color: #dc3545;
            border-color: #dc3545;
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
                <h2 class="fw-bold text-dark">Field Details</h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.fields.edit', $field) }}" class="btn btn-custom">
                        <i class="fas fa-edit me-2"></i>Edit Field
                    </a>
                    <a href="{{ route('admin.fields.index') }}" class="btn btn-outline-danger">
                        <i class="fas fa-arrow-left me-2"></i>Back to Fields
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

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
                        <div class="h2 mb-0">৳{{ (int) $field->price_per_90min }}</div>
                        <p class="mb-0">per 90 minutes</p>
                        <span class="badge 
                            @if($field->status == 'available') bg-success
                            @elseif($field->status == 'maintenance') bg-warning
                            @else bg-danger
                            @endif mt-2">
                            {{ ucfirst($field->status) }}
                        </span>
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

                <!-- Time Slots Management -->
                <div class="col-lg-4">
                    <div class="info-card">
                        <h4 class="fw-bold mb-3">
                            <i class="fas fa-calendar-alt me-2"></i>Time Slots Management
                        </h4>
                        <p class="text-muted mb-3">Configure available time slots for this field.</p>
                        
                        <form method="POST" action="{{ route('admin.fields.update-time-slots', $field) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="time-slots-grid" id="time-slots-container">
                                @php
                                    $slots = $field->generateTimeSlots();
                                @endphp
                                
                                @foreach($slots as $index => $slot)
                                    <div class="time-slot {{ $slot['available'] ? 'available' : 'unavailable' }}">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="time_slots[{{ $index }}][available]" 
                                                   value="1" 
                                                   {{ $slot['available'] ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <div class="fw-bold">{{ $slot['start_time'] }}</div>
                                                <div class="small">{{ $slot['end_time'] }}</div>
                                            </label>
                                        </div>
                                        <input type="hidden" name="time_slots[{{ $index }}][start_time]" value="{{ $slot['start_time'] }}">
                                        <input type="hidden" name="time_slots[{{ $index }}][end_time]" value="{{ $slot['end_time'] }}">
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="mt-3">
                                <button type="submit" class="btn btn-custom w-100">
                                    <i class="fas fa-save me-2"></i>Update Time Slots
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="info-card">
                        <h5 class="fw-bold mb-3">Quick Actions</h5>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.fields.edit', $field) }}" class="btn btn-outline-danger">
                                <i class="fas fa-edit me-2"></i>Edit Field
                            </a>
                            <form method="POST" action="{{ route('admin.fields.destroy', $field) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100" 
                                        onclick="return confirm('Are you sure you want to delete this field?')">
                                    <i class="fas fa-trash me-2"></i>Delete Field
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle time slot availability
        document.querySelectorAll('.form-check-input').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const timeSlot = this.closest('.time-slot');
                if (this.checked) {
                    timeSlot.classList.remove('unavailable');
                    timeSlot.classList.add('available');
                } else {
                    timeSlot.classList.remove('available');
                    timeSlot.classList.add('unavailable');
                }
            });
        });
    </script>
</body>
</html>
