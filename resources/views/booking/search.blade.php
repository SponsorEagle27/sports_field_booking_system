<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn - Search Fields</title>
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
        .form-label {
            font-weight: bold;
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
        .loading {
            text-align: center;
            padding: 40px;
        }
        .no-results {
            text-align: center;
            padding: 40px;
            color: #6c757d;
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
        .favorite-btn.loading {
            background: #adb5bd; /* neutral gray */
            cursor: default;
            pointer-events: none;
        }
        .favorite-btn.loading,
        .favorite-btn.loading:hover {
            transform: none !important;
        }
        .favorite-btn:hover {
            background: #c82333;
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
            <h2 class="fw-bold text-dark mb-4">
                <i class="fas fa-search me-2"></i>Find Your Perfect Field
            </h2>
            <form id="search-filter-form" autocomplete="off">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <label for="sport" class="form-label">Sport</label>
                        <select class="form-select" id="sport" name="sport" required>
                            <option value="" selected disabled>Select Sport</option>
                            <option value="football">Football</option>
                            <option value="basketball">Basketball</option>
                            <option value="tabletennis">Table Tennis</option>
                            <option value="cricket">Cricket</option>
                            <option value="badminton">Badminton</option>
                            <option value="paddle">Paddle</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="size" class="form-label">Size</label>
                         <select class="form-select" id="size" name="size">
                             <option value="" selected>All Sizes</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="surface" class="form-label">Surface</label>
                         <select class="form-select" id="surface" name="surface">
                            <option value="all" selected>All Surfaces</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-custom btn-lg" id="search-button">
                        <i class="fas fa-search me-2"></i>Search Fields
                    </button>
                </div>
            </form>

            <!-- Results Section -->
            <div id="search-results" class="mt-4" style="display: none;">
                <h3 class="fw-bold mb-3">Available Fields</h3>
                <div id="results-container"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sizeOptions = {
            football: [
                { value: '11-a-side', label: '11-a-side' },
                { value: '7-a-side', label: '7-a-side' },
                { value: '5-a-side', label: '5-a-side' }
            ],
            basketball: [
                { value: 'Full Size', label: 'Full Size' }
            ],
            tabletennis: [
                { value: 'Full Size', label: 'Full Size' }
            ],
            cricket: [
                { value: 'Full Size', label: 'Full Size' }
            ],
            badminton: [
                { value: 'Full Size', label: 'Full Size' }
            ],
            paddle: [
                { value: 'Full Size', label: 'Full Size' }
            ]
        };
        const surfaceOptions = {
            football: [
                { value: 'all', label: 'All Surfaces' },
                { value: 'Grass', label: 'Grass' },
                { value: 'Artificial Turf', label: 'Artificial Turf' }
            ],
            basketball: [
                { value: 'all', label: 'All Surfaces' },
                { value: 'Outdoor Court', label: 'Outdoor Court' },
                { value: 'Indoor Court', label: 'Indoor Court' }
            ],
            tabletennis: [
                { value: 'all', label: 'All Surfaces' },
                { value: 'Outdoor Court', label: 'Outdoor Court' },
                { value: 'Indoor Court', label: 'Indoor Court' }
            ],
            cricket: [
                { value: 'all', label: 'All Surfaces' },
                { value: 'Grass', label: 'Grass' },
                { value: 'Artificial Turf', label: 'Artificial Turf' },
                { value: 'Indoor Court', label: 'Indoor Court' }
            ],
            badminton: [
                { value: 'all', label: 'All Surfaces' },
                { value: 'Outdoor Court', label: 'Outdoor Court' },
                { value: 'Indoor Court', label: 'Indoor Court' }
            ],
            paddle: [
                { value: 'all', label: 'All Surfaces' },
                { value: 'Outdoor Court', label: 'Outdoor Court' },
                { value: 'Indoor Court', label: 'Indoor Court' }
            ]
        };

        document.getElementById('sport').addEventListener('change', function() {
            const sport = this.value;
            console.log('Sport selected:', sport); // Debug log
            
            // Update Size
            const sizeSelect = document.getElementById('size');
            sizeSelect.innerHTML = '<option value="" selected>All Sizes</option>';
            sizeOptions[sport].forEach(opt => {
                sizeSelect.innerHTML += `<option value="${opt.value}">${opt.label}</option>`;
            });
            sizeSelect.disabled = false;
            
            // Update Surface
            const surfaceSelect = document.getElementById('surface');
            surfaceSelect.innerHTML = '';
            surfaceOptions[sport].forEach(opt => {
                surfaceSelect.innerHTML += `<option value="${opt.value}">${opt.label}</option>`;
            });
            surfaceSelect.disabled = false;
            
            // Button is always enabled - user can search with any combination
            console.log('Sport selected:', sport); // Debug log
        });

        document.getElementById('size').addEventListener('change', function() {
            console.log('Size selected:', this.value); // Debug log
        });
        
        document.getElementById('surface').addEventListener('change', function() {
            console.log('Surface selected:', this.value); // Debug log
        });

        // Initialize the form state
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing form...'); // Debug log
            const searchButton = document.querySelector('button[type="submit"]');
            
            // Enable the button by default - user can search with any combination
            searchButton.disabled = false;
            console.log('Initial button state:', searchButton.disabled); // Debug log
        });

        // Handle form submission
        document.getElementById('search-filter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted!'); // Debug log
            
            // If no sport is selected, show all fields
            const sport = document.getElementById('sport').value;
            if (!sport) {
                // Show all fields without filters
                showAllFields();
                return;
            }
            
            const formData = new FormData(this);
            const resultsContainer = document.getElementById('results-container');
            const searchResults = document.getElementById('search-results');
            
            // Log form data for debugging
            console.log('Sport:', formData.get('sport'));
            console.log('Size:', formData.get('size'));
            console.log('Surface:', formData.get('surface'));
            
            // Show loading
            searchResults.style.display = 'block';
            resultsContainer.innerHTML = `
                <div class="loading">
                    <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                    <p>Searching for available fields...</p>
                </div>
            `;

            // Make AJAX request
            fetch('{{ route("booking.search-fields") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => {
                console.log('Response status:', response.status); // Debug log
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data); // Debug log
                console.log('Fields count:', data.fields.length); // Debug count
                if (data.success) {
                    displayResults(data.fields);
                } else {
                    resultsContainer.innerHTML = `
                        <div class="no-results">
                            <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                            <p>No fields found matching your criteria.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                resultsContainer.innerHTML = `
                    <div class="no-results">
                        <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                        <p>An error occurred while searching. Please try again.</p>
                    </div>
                `;
            });
        });

        function displayResults(fields) {
            const resultsContainer = document.getElementById('results-container');
            
            console.log('Displaying fields:', fields.length); // Debug count
            console.log('Fields data:', fields); // Debug data
            
            if (fields.length === 0) {
                resultsContainer.innerHTML = `
                    <div class="no-results">
                        <i class="fas fa-search fa-2x mb-3"></i>
                        <p>No fields found matching your criteria.</p>
                        <p>Try adjusting your search filters.</p>
                    </div>
                `;
                return;
            }

            let html = '';
            fields.forEach(field => {
                html += `
                    <div class="field-card">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="fw-bold mb-2">${field.name}</h4>
                                <p class="field-location mb-2">
                                    <i class="fas fa-map-marker-alt me-1"></i>${field.location}
                                </p>
                                <p class="mb-2">${field.address}</p>
                                <div class="field-amenities">
                                    <span class="badge badge-custom me-2">${field.sport_type}</span>
                                    <span class="badge badge-custom me-2">${field.size}</span>
                                    <span class="badge badge-custom me-2">${field.surface}</span>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="field-price mb-2">৳${Math.round(field.price_per_90min)}</div>
                                <p class="text-muted mb-2">per 90 minutes</p>
                                <div class="d-flex justify-content-end gap-2">
                                    <button class="btn btn-custom" onclick="viewField(${field.id})">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </button>
                                    <button class="favorite-btn loading" onclick="toggleFavorite(${field.id}, this)" data-field-id="${field.id}" id="favorite-${field.id}" title="Add to Favorites">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            resultsContainer.innerHTML = html;
            
            // Initialize favorite buttons without extra API
            fields.forEach(field => {
                const favoriteBtn = document.getElementById(`favorite-${field.id}`);
                if (!favoriteBtn) return;
                favoriteBtn.classList.remove('loading');
                if (field.is_favorited) {
                    favoriteBtn.classList.remove('not-favorited');
                    favoriteBtn.style.background = '#dc3545';
                } else {
                    favoriteBtn.classList.add('not-favorited');
                    favoriteBtn.style.background = '#6c757d';
                }
            });
        }

        function showAllFields() {
            const resultsContainer = document.getElementById('results-container');
            const searchResults = document.getElementById('search-results');
            
            // Show results section
            searchResults.style.display = 'block';
            
            // Show loading
            resultsContainer.innerHTML = `
                <div class="loading">
                    <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                    <p>Loading all available fields...</p>
                </div>
            `;
            
            // Fetch all fields
            fetch('{{ route("booking.search-fields") }}', {
                method: 'POST',
                body: new FormData(),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayResults(data.fields);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                resultsContainer.innerHTML = `
                    <div class="no-results">
                        <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                        <p>An error occurred while loading fields.</p>
                    </div>
                `;
            });
        }

        function viewField(fieldId) {
            window.location.href = `/booking/field/${fieldId}`;
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
                        button.innerHTML = '<i class="fas fa-star"></i>';
                    } else {
                        // Field was removed from favorites
                        button.classList.add('not-favorited');
                        button.style.background = '#6c757d';
                        button.innerHTML = '<i class="fas fa-star"></i>';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating favorites.');
            });
        }
        
        // Removed per-card check-status; handled in search response
    </script>
</body>
</html>