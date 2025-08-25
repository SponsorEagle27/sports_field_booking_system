<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameOn Login Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            padding: 20px;
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
        
        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 3.5rem;
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #00ff41, #00cc33);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.8rem;
            color: black;
            box-shadow: 0 10px 25px rgba(0, 255, 65, 0.3);
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }
        
        .page-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            font-weight: 400;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            color: white;
            font-weight: 500;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        
        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .input-group:focus-within {
            border-color: #00ff41;
            box-shadow: 0 0 0 0.2rem rgba(0, 255, 65, 0.25);
            background: rgba(255, 255, 255, 0.15);
        }
        
        .input-group-text {
            background: transparent;
            border: none;
            color: #00ff41;
            padding: 0 1rem;
            font-size: 1rem;
            min-width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .form-control {
            background: transparent;
            border: none;
            padding: 1rem 1.25rem;
            color: white;
            font-size: 1rem;
            flex: 1;
            min-height: 56px;
            outline: none;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
            font-weight: 400;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .form-check-input {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            width: 18px;
            height: 18px;
            margin-right: 0.75rem;
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background: #00ff41;
            border-color: #00ff41;
        }
        
        .form-check-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            cursor: pointer;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #00ff41, #00cc33);
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            color: black;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 100%;
            min-height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin: 2rem 0 1.5rem 0;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 255, 65, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ff6b6b;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .alert-danger ul {
            margin: 0;
            padding-left: 1.25rem;
        }
        
        .text-muted {
            color: rgba(255, 255, 255, 0.7) !important;
        }
        
        .text-decoration-none {
            color: #00ff41;
            transition: all 0.3s ease;
            font-weight: 600;
            text-decoration: none;
        }
        
        .text-decoration-none:hover {
            color: #00cc33;
            text-decoration: underline;
        }
        
        .fw-bold {
            color: #00ff41;
        }
        
        .footer-links {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .footer-links p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
        }
        
        .forgot-password {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .forgot-password:hover {
            color: rgba(255, 255, 255, 0.8);
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
        
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .login-card {
                padding: 2.5rem 2rem;
                margin: 0;
            }
            
            .logo-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .page-title {
                font-size: 1.75rem;
            }
        }
        
        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
            }
            
            .logo-icon {
                width: 55px;
                height: 55px;
                font-size: 1.3rem;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-animation"></div>
    
    <div class="login-card animate-fade-in">
        <div class="logo-container animate-fade-in animate-delay-1">
            <div class="logo-icon">
                <i class="fas fa-futbol"></i>
            </div>
            <h1 class="page-title">Welcome Back</h1>
            <p class="page-subtitle">Sign in to your GameOn account</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger animate-fade-in animate-delay-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="animate-fade-in animate-delay-2">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>

            <button type="submit" class="btn btn-primary animate-fade-in animate-delay-3">
                <i class="fas fa-sign-in-alt"></i>
                Sign In
            </button>
        </form>

        <div class="footer-links animate-fade-in animate-delay-3">
            <p>Don't have an account? 
                <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a>
            </p>
            <a href="#" class="forgot-password">Forgot your password?</a>
        </div>
    </div>
</body>
</html> 