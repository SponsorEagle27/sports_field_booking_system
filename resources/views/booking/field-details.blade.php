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
        
        /* Time slot dropdown styling */
        .form-select option:disabled {
            color: #dc3545 !important;
            font-weight: bold;
        }
        
        .form-select option:not(:disabled) {
            color: #28a745 !important;
            font-weight: bold;
        }
        
        .bkash-badge {
            background-color: #e2136e;
            color: #ffffff;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
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
                        <div class="field-price" id="field-price">৳{{ (int) $field->price_per_90min }}</div>
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
                        <div id="booking-feedback" class="mb-3"></div>
                        
                        <form id="booking-form">
                            <div class="mb-3">
                                <label for="booking_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="booking_date" required min="{{ date('Y-m-d') }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="time_slot" class="form-label">Available Time Slots (90 minutes each)</label>
                                <select class="form-select" id="time_slot" name="time_slot" required disabled>
                                    <option value="">Please select a date first</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="pay_cash" value="cash">
                                    <label class="form-check-label" for="pay_cash">
                                        Pay on field (Cash)
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="pay_bkash" value="bkash">
                                    <label class="form-check-label d-flex align-items-center gap-2" for="pay_bkash">
                                        <span class="bkash-badge">Pay via bKash</span>
                                        <img src="{{ asset('images/bKash-icon.png') }}" alt="bKash" style="height:20px;width:auto;"/>
                                    </label>
                                </div>

                                <!-- bKash extra fields -->
                                <div id="bkash-extra" class="mt-3" style="display:none;">
                                    <div class="mb-2">
                                        <label for="bkash_txn" class="form-label">Transaction ID</label>
                                        <input type="text" class="form-control" id="bkash_txn" placeholder="eg 7DF3KLMN9L" autocomplete="off" minlength="10" maxlength="10">
                                        <small class="text-muted">Must be exactly 10 characters.</small>
                                    </div>
                                    <div class="mb-2">
                                        <label for="bkash_ref" class="form-label">Reference</label>
                                        <input type="text" class="form-control" id="bkash_ref" placeholder="Your phone/email/reference" autocomplete="off">
                                    </div>
                                    <small class="text-muted">Both fields are required for bKash payments.</small>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-custom w-100" id="book-button" disabled>
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
        let selectedTimeSlot = null;
        let selectedPaymentMethod = null;
        
        // Check favorite status when page loads
        document.addEventListener('DOMContentLoaded', function() {
            checkFavoriteStatus({{ $field->id }}, document.getElementById('favorite-{{ $field->id }}'));
            window.basePrice = {{ (int) $field->price_per_90min }};
            
            // Add event listener for date change
            document.getElementById('booking_date').addEventListener('change', function() {
                const date = this.value;
                if (date) {
                    loadTimeSlots(date);
                } else {
                    const timeSlotSelect = document.getElementById('time_slot');
                    timeSlotSelect.innerHTML = '<option value="">Please select a date first</option>';
                    timeSlotSelect.disabled = true;
                    updateBookButtonState();
                    document.getElementById('field-price').textContent = `৳${window.basePrice}`;
                }
            });

            // Payment method selection
            document.querySelectorAll('input[name="payment_method"]').forEach(r => {
                r.addEventListener('change', function() {
                    selectedPaymentMethod = this.value;
                    // Toggle bKash extra fields
                    const extra = document.getElementById('bkash-extra');
                    if (this.value === 'bkash') {
                        extra.style.display = '';
                    } else {
                        extra.style.display = 'none';
                    }
                    updateBookButtonState();
                });
            });

            // bKash inputs should update button state while typing
            const txnInput = document.getElementById('bkash_txn');
            const refInput = document.getElementById('bkash_ref');
            if (txnInput) txnInput.addEventListener('input', updateBookButtonState);
            if (refInput) refInput.addEventListener('input', updateBookButtonState);
            // Handle booking submission
            const form = document.getElementById('booking-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (!selectedTimeSlot || !selectedPaymentMethod) return;

                const payload = {
                    date: document.getElementById('booking_date').value,
                    start_time: selectedTimeSlot.start,
                    end_time: selectedTimeSlot.end,
                    price: selectedTimeSlot.price,
                    payment_method: selectedPaymentMethod,
                    bkash_txn: selectedPaymentMethod === 'bkash' ? document.getElementById('bkash_txn').value.trim() : null,
                    bkash_ref: selectedPaymentMethod === 'bkash' ? document.getElementById('bkash_ref').value.trim() : null,
                };

                fetch('{{ route("booking.book", $field->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(payload)
                })
                .then(r => r.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.message || 'Could not complete booking.');
                        return;
                    }
                    // Refresh slots to reflect the new booking
                    loadTimeSlots(document.getElementById('booking_date').value);
                    // Disable submit and reset selection
                    selectedTimeSlot = null;
                    document.getElementById('time_slot').value = '';
                    updateBookButtonState();
                    const fb = document.getElementById('booking-feedback');
                    fb.innerHTML = '<div class="alert alert-success">Your booking has been confirmed. See you soon!</div>';
                    fb.scrollIntoView({ behavior: 'smooth', block: 'center' });
                })
                .catch(err => {
                    console.error(err);
                    alert('An error occurred while booking.');
                });
            });
        });
        
        function loadTimeSlots(date) {
            if (!date) return;
            
            const timeSlotSelect = document.getElementById('time_slot');
            timeSlotSelect.innerHTML = '<option value="">Loading time slots...</option>';
            
            // Fetch real booking availability from server
            fetch('{{ route("booking.check-availability", $field->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    date: date
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.slots.length > 0) {
                    // Clear and populate dropdown
                    timeSlotSelect.innerHTML = '<option value="">Select a time slot</option>';
                    
                    data.slots.forEach(slot => {
                        const startTime = formatTime(slot.start_time);
                        const endTime = formatTime(slot.end_time);
                        const priceText = `৳${slot.price}`;
                        const peakBadge = slot.peak ? ' \u26A1' : ''; // lightning symbol
                        const optionText = `${startTime} - ${endTime} ${peakBadge} — ${priceText}`;
                        
                        const option = document.createElement('option');
                        option.value = `${slot.start_time}-${slot.end_time}-${slot.price}`;
                        
                        if (slot.available) {
                            option.textContent = optionText + ' (Available)';
                            option.style.color = '#28a745'; // Green color for available slots
                        } else {
                            option.textContent = optionText + ' (Booked)';
                            option.disabled = true;
                            option.style.color = '#dc3545'; // Red color for booked slots
                        }
                        
                        timeSlotSelect.appendChild(option);
                    });
                    
                    timeSlotSelect.disabled = false;
                } else {
                    timeSlotSelect.innerHTML = '<option value="">No available time slots for this date</option>';
                    timeSlotSelect.disabled = true;
                    document.getElementById('book-button').disabled = true;
                    document.getElementById('field-price').textContent = `৳${window.basePrice}`;
                }
            })
            .catch(error => {
                console.error('Error loading time slots:', error);
                timeSlotSelect.innerHTML = '<option value="">Error loading time slots</option>';
                timeSlotSelect.disabled = true;
                document.getElementById('book-button').disabled = true;
            });
            
            // Add event listener for time slot selection
            timeSlotSelect.addEventListener('change', function() {
                if (this.value && !this.options[this.selectedIndex].disabled) {
                    const parts = this.value.split('-');
                    selectedTimeSlot = {
                        start: parts[0],
                        end: parts[1],
                        price: parseInt(parts[2])
                    };
                    updateBookButtonState();
                    document.getElementById('field-price').textContent = `৳${selectedTimeSlot.price}`;
                } else {
                    selectedTimeSlot = null;
                    updateBookButtonState();
                    document.getElementById('field-price').textContent = `৳${window.basePrice}`;
                }
            });
        }

        function updateBookButtonState() {
            let canBook = !!selectedTimeSlot && !!selectedPaymentMethod;
            if (selectedPaymentMethod === 'bkash') {
                const txn = document.getElementById('bkash_txn').value.trim();
                const ref = document.getElementById('bkash_ref').value.trim();
                const validTxn = txn.length === 10; // exactly 10 characters
                canBook = canBook && validTxn && ref.length > 0;
                // simple inline feedback
                const txnInput = document.getElementById('bkash_txn');
                if (txn.length === 0) {
                    txnInput.classList.remove('is-invalid');
                } else if (!validTxn) {
                    txnInput.classList.add('is-invalid');
                } else {
                    txnInput.classList.remove('is-invalid');
                }
            }
            document.getElementById('book-button').disabled = !canBook;
        }
        
        function formatTime(time24) {
            const [hours, minutes] = time24.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const hour12 = hour % 12 || 12;
            return `${hour12}:${minutes} ${ampm}`;
        }
        
        
        
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