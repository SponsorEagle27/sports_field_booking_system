<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GameOn - Sports Field Booking System</title>
        
        <!-- Font Awesome for Icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #00ff41 100%);
                min-height: 100vh;
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
                    radial-gradient(circle at 20% 80%, rgba(0, 255, 65, 0.2) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(0, 255, 65, 0.15) 0%, transparent 50%),
                    radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
                animation: float 6s ease-in-out infinite;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                33% { transform: translateY(-20px) rotate(1deg); }
                66% { transform: translateY(10px) rotate(-1deg); }
            }
            
            /* Navigation */
            .navbar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                padding: 1rem 2rem;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .nav-container {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .logo {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                color: white;
                font-size: 1.5rem;
                font-weight: 800;
                text-decoration: none;
            }
            
            .logo-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, #00ff41, #00cc33);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                color: black;
            }
            
            .nav-links {
                display: flex;
                gap: 2rem;
                align-items: center;
            }
            
            .nav-link {
                color: white;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
                padding: 0.5rem 1rem;
                border-radius: 8px;
            }
            
            .nav-link:hover {
                background: rgba(255, 255, 255, 0.1);
                transform: translateY(-2px);
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #00ff41, #00cc33);
                color: black;
                padding: 0.75rem 1.5rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
            }
            
            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(0, 255, 65, 0.4);
            }
            
            /* Hero Section */
            .hero {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
                padding-top: 6rem;
                position: relative;
            }
            
            .hero-content {
                max-width: 1200px;
                text-align: center;
                color: white;
            }
            
            .hero-title {
                font-size: clamp(3rem, 8vw, 6rem);
                font-weight: 900;
                margin-bottom: 1rem;
                line-height: 1.1;
            }
            
            .hero-title span {
                background: linear-gradient(135deg, #00ff41, #00cc33, #ffffff);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .hero-subtitle {
                font-size: clamp(1.2rem, 3vw, 1.5rem);
                margin-bottom: 3rem;
                opacity: 0.9;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
            }
            
            /* Sports Grid */
            .sports-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
                max-width: 800px;
                margin: 3rem auto;
            }
            
            .sport-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                padding: 2rem;
                text-align: center;
                transition: all 0.3s ease;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .sport-card:hover {
                transform: translateY(-10px);
                background: rgba(255, 255, 255, 0.2);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            }
            
            .sport-icon {
                font-size: 3rem;
                margin-bottom: 1rem;
                color: #00ff41;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 70px;
            }
            
            .sport-name {
                font-weight: 600;
                font-size: 1.1rem;
            }
            
            /* CTA Buttons */
            .cta-buttons {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
                margin: 3rem 0;
            }
            
            .btn-secondary {
                background: transparent;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 25px;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                border: 2px solid white;
            }
            
            .btn-secondary:hover {
                background: white;
                color: #667eea;
                transform: translateY(-3px);
            }
            
            /* Features */
            .features {
                margin-top: 4rem;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 2rem;
                max-width: 1000px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .feature {
                text-align: center;
                color: white;
            }
            
            .feature-icon {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #00ff41, #00cc33);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 1rem;
                font-size: 2rem;
                color: black;
            }
            
            .feature-title {
                font-weight: 700;
                font-size: 1.2rem;
                margin-bottom: 0.5rem;
            }
            
            .feature-desc {
                opacity: 0.8;
                line-height: 1.6;
            }
            
            /* Responsive */
            @media (max-width: 768px) {
                .navbar {
                    padding: 1rem;
                }
                
                .nav-links {
                    gap: 1rem;
                }
                
                .hero {
                    padding: 1rem;
                }
                
                .sports-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 1rem;
                }
                
                .cta-buttons {
                    flex-direction: column;
                    align-items: center;
                }
                
                .features {
                    grid-template-columns: 1fr;
                }
            }
            
            @media (max-width: 480px) {
                .sports-grid {
                    grid-template-columns: repeat(1, 1fr);
                    gap: 1rem;
                }
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
            .animate-delay-4 { animation-delay: 0.4s; }
        </style>
    </head>
    <body>
        <!-- Animated Background -->
        <div class="bg-animation"></div>
        
        <!-- Navigation -->
        <nav class="navbar">
            <div class="nav-container">
                <a href="/" class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-futbol"></i>
                    </div>
                    GameOn
                </a>
                
                <div class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>
        
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title animate-fade-in">
                    Welcome to <span>GameOn</span>
                </h1>
                
                <p class="hero-subtitle animate-fade-in animate-delay-1">
                    Book your favorite sports fields with ease. Get ready to play, compete, and win!
                </p>
                
                <!-- Sports Grid -->
                <div class="sports-grid animate-fade-in animate-delay-2">
                    <div class="sport-card">
                        <div class="sport-icon">
                            <img src="{{ asset('images/football-icon.png') }}" alt="Football" style="width: 60px; height: 60px; filter: brightness(0) saturate(100%) invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);">
                        </div>
                        <div class="sport-name">Football</div>
                    </div>
                    
                    <div class="sport-card">
                        <div class="sport-icon">
                            <i class="fas fa-basketball-ball"></i>
                        </div>
                        <div class="sport-name">Basketball</div>
                    </div>
                    
                    <div class="sport-card">
                        <div class="sport-icon">
                            <i class="fas fa-table-tennis"></i>
                        </div>
                        <div class="sport-name">Table Tennis</div>
                    </div>
                    

                    
                    <div class="sport-card">
                        <div class="sport-icon">
                            <img src="{{ asset('images/cricket-icon.png.png') }}" alt="Cricket" style="width: 60px; height: 60px; filter: brightness(0) saturate(100%) invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);">
                        </div>
                        <div class="sport-name">Cricket</div>
                    </div>
                    
                    <div class="sport-card">
                        <div class="sport-icon">
                            <img src="{{ asset('images/badminton-icon.png') }}" alt="Badminton" style="width: 60px; height: 60px; filter: brightness(0) saturate(100%) invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);">
                        </div>
                        <div class="sport-name">Badminton</div>
                    </div>
                    
                    <div class="sport-card">
                        <div class="sport-icon">
                            <img src="{{ asset('images/paddle-icon.png') }}" alt="Paddle" style="width: 70px; height: 70px; filter: brightness(0) saturate(100%) invert(48%) sepia(79%) saturate(2476%) hue-rotate(86deg) brightness(118%) contrast(119%);">
                        </div>
                        <div class="sport-name">Paddle</div>
                    </div>
                </div>
                
                <!-- Call to Action -->
                <div class="cta-buttons animate-fade-in animate-delay-3">
                    <a href="{{ route('register') }}" class="btn-primary">
                        
                        Get Started
                    </a>
                    <a href="{{ route('login') }}" class="btn-secondary">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign In
                    </a>
                </div>
                
                <!-- Features -->
                <div class="features animate-fade-in animate-delay-4">
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 class="feature-title">Easy Booking</h3>
                        <p class="feature-desc">Book your favorite fields in just a few clicks</p>
                    </div>
                    
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="feature-title">24/7 Availability</h3>
                        <p class="feature-desc">Book anytime, anywhere with our mobile-friendly platform</p>
                    </div>
                    
                    <div class="feature">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3 class="feature-title">Premium Fields</h3>
                        <p class="feature-desc">Access to the best sports facilities in your area</p>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
