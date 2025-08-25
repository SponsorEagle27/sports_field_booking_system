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
            
            #about-btn {
                border: 1px solid rgba(0, 255, 65, 0.3);
                background: rgba(0, 255, 65, 0.1);
            }
            
            #about-btn:hover {
                background: rgba(0, 255, 65, 0.2);
                border-color: rgba(0, 255, 65, 0.5);
                color: #00ff41;
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
                
                .about-section {
                    padding: 2rem 1rem;
                }
                
                .about-title {
                    font-size: 2rem;
                }
                
                .about-content {
                    padding: 1.5rem;
                }
                
                .about-features {
                    grid-template-columns: 1fr;
                    gap: 1rem;
                }
                
                .back-to-top {
                    bottom: 20px;
                    right: 20px;
                    width: 45px;
                    height: 45px;
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
            .animate-delay-5 { animation-delay: 0.5s; }
            
            /* Smooth Scrolling */
            html {
                scroll-behavior: smooth;
            }
            
            /* About Section */
            .about-section {
                margin-top: 5rem;
                padding: 3rem 0;
                text-align: center;
                color: white;
                max-width: 1000px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .about-title {
                font-size: 2.5rem;
                font-weight: 800;
                margin-bottom: 2rem;
                background: linear-gradient(135deg, #00ff41, #00cc33);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            
            .about-content {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                padding: 2.5rem;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .about-text p {
                font-size: 1.1rem;
                line-height: 1.8;
                margin-bottom: 1.5rem;
                opacity: 0.9;
            }
            
            .about-text strong {
                color: #00ff41;
            }
            
            .about-features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
                margin: 2rem 0;
            }
            
            .about-feature {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 1rem;
                background: rgba(0, 255, 65, 0.1);
                border-radius: 15px;
                border: 1px solid rgba(0, 255, 65, 0.3);
                transition: all 0.3s ease;
            }
            
            .about-feature:hover {
                transform: translateY(-5px);
                background: rgba(0, 255, 65, 0.2);
                border-color: rgba(0, 255, 65, 0.5);
            }
            
            .about-feature i {
                font-size: 1.5rem;
                color: #00ff41;
                width: 30px;
                text-align: center;
            }
            
            .about-feature span {
                font-weight: 600;
                font-size: 1rem;
            }
            
            /* Back to Top Button */
            .back-to-top {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 50px;
                height: 50px;
                background: linear-gradient(135deg, #00ff41, #00cc33);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: black;
                text-decoration: none;
                font-size: 1.2rem;
                opacity: 0;
                visibility: hidden;
                transform: translateY(20px);
                transition: all 0.3s ease;
                z-index: 1000;
                box-shadow: 0 5px 15px rgba(0, 255, 65, 0.3);
            }
            
            .back-to-top.show {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            
            .back-to-top:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 255, 65, 0.5);
            }
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
                    <a href="#about" class="nav-link" id="about-btn">About</a>
                    @auth
                        <span class="nav-link" style="color: #00ff41; font-weight: 600;">Welcome, {{ Auth::user()->name }}!</span>
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-primary" style="background: linear-gradient(135deg, #ff4444, #cc3333);">Logout</button>
                        </form>
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
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Go to Dashboard
                        </a>
                        <a href="{{ route('booking.search') }}" class="btn-secondary">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Book Now
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="btn-secondary">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </a>
                    @endauth
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
                
                <!-- About Section -->
                <div id="about" class="about-section animate-fade-in animate-delay-5">
                    <h2 class="about-title">About GameOn</h2>
                    <div class="about-content">
                        <div class="about-text">
                            <p>GameOn is your premier sports field booking platform, designed to connect sports enthusiasts with the best facilities across Dhaka. Whether you're a professional athlete, a weekend warrior, or just looking to have some fun with friends, we've got you covered.</p>
                            
                            <p>Our platform features <strong> premium sports fields</strong> including football pitches, basketball courts, cricket grounds, badminton courts, table tennis facilities, and paddle courts. Each venue is carefully selected to ensure quality, safety, and an exceptional playing experience.</p>
                            
                            <div class="about-features">
                                <div class="about-feature">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Prime Locations</span>
                                </div>
                                <div class="about-feature">
                                    <i class="fas fa-clock"></i>
                                    <span>Flexible Scheduling</span>
                                </div>
                                <div class="about-feature">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Safe & Secure</span>
                                </div>
                                <div class="about-feature">
                                    <i class="fas fa-mobile-alt"></i>
                                    <span>Mobile Friendly</span>
                                </div>
                            </div>
                            
                            <p>Join thousands of satisfied players who trust GameOn for their sports field bookings. Start your journey today and experience the convenience of modern sports facility management!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Back to Top Button -->
        <a href="#" class="back-to-top" id="back-to-top">
            <i class="fas fa-arrow-up"></i>
        </a>
        
        <!-- JavaScript -->
        <script>
            // Smooth scroll to About section
            document.getElementById('about-btn').addEventListener('click', function(e) {
                e.preventDefault();
                const aboutSection = document.getElementById('about');
                aboutSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            });
            
            // Add scroll effect to About section
            window.addEventListener('scroll', function() {
                const aboutSection = document.getElementById('about');
                const rect = aboutSection.getBoundingClientRect();
                const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;
                
                if (isVisible) {
                    aboutSection.style.opacity = '1';
                    aboutSection.style.transform = 'translateY(0)';
                }
            });
            
            // Initialize About section animation
            document.addEventListener('DOMContentLoaded', function() {
                const aboutSection = document.getElementById('about');
                aboutSection.style.opacity = '0';
                aboutSection.style.transform = 'translateY(30px)';
                aboutSection.style.transition = 'all 0.8s ease-out';
            });
            
            // Back to Top button functionality
            const backToTopBtn = document.getElementById('back-to-top');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            });
            
            backToTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        </script>
    </body>
</html>
