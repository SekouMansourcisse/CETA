@extends('layouts.auth')

@section('content')
<!-- Container principal avec arrière-plan 3D -->
<div class="login-wrapper">
    <!-- Arrière-plan 3D animé -->
    <div class="background-3d">
        <div class="architecture-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
            <div class="shape shape-6"></div>
        </div>
        <div class="grid-overlay"></div>
    </div>

    <!-- Conteneur de connexion centré -->
    <div class="login-container">
        <div class="login-card">
            <!-- Header avec logo et titre -->
            <div class="login-header text-center mb-4">
                <div class="logo-container mb-3">
                    <img src="{{ asset('template_assets/img/logo.jpg') }}" alt="Logo" style="width: 80px; height: auto; border-radius: 50%;">
                </div>
                <h2 class="welcome-title">Bienvenue</h2>
                <p class="welcome-subtitle">Cabinet d'Architecture</p>
                <div class="title-divider"></div>
            </div>

            <!-- Formulaire de connexion -->
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <!-- Champ Login -->
                <div class="form-group mb-4">
                    <label class="form-label">Identifiant</label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <input id="login" 
                               type="text" 
                               class="form-control modern-input @error('login') is-invalid @enderror" 
                               name="login" 
                               value="{{ old('login') }}" 
                               required 
                               autocomplete="login" 
                               autofocus
                               placeholder="Votre identifiant">
                    </div>
                    @error('login')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Champ Mot de passe -->
                <div class="form-group mb-4">
                    <label class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <div class="input-icon">
                            <i class="fas fa-lock text-primary"></i>
                        </div>
                        <input id="password" 
                               type="password" 
                               class="form-control modern-input @error('password') is-invalid @enderror" 
                               name="password" 
                               required 
                               autocomplete="current-password"
                               placeholder="Votre mot de passe">
                        <div class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye-slash" id="toggleIcon"></i>
                        </div>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Options -->
                <div class="form-options mb-4">
                    <div class="remember-me">
                        <label class="custom-checkbox">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Se souvenir de moi
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Bouton de connexion -->
                <div class="form-group mb-4">
                    <button type="submit" class="btn btn-primary btn-modern w-100">
                        <span class="btn-text">Se connecter</span>
                        <i class="fas fa-arrow-right btn-icon"></i>
                    </button>
                </div>

                <!-- Lien d'inscription -->
                <div class="register-link text-center">
                    <p class="mb-0">
                        Vous n'avez pas de compte ? 
                        <a href="{{ route('register') }}" class="register-link-text">
                            S'inscrire
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="login-footer text-center mt-4">
            <p class="copyright-text">
                © 2025 Cabinet d'Architecture. Tous droits réservés.
            </p>
        </div>
    </div>
</div>

<style>
    /* Reset et styles de base */
    * {
        box-sizing: border-box;
    }

    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        overflow: hidden;
    }

    /* Container principal */
    .login-wrapper {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        overflow: hidden;
    }

    /* Arrière-plan 3D architectural */
    .background-3d {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        overflow: hidden;
    }

    .architecture-shapes {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
        width: 200px;
        height: 200px;
        top: 10%;
        left: 10%;
        transform: perspective(1000px) rotateX(45deg) rotateY(45deg);
        animation-delay: 0s;
        border-radius: 20px;
    }

    .shape-2 {
        width: 150px;
        height: 300px;
        top: 20%;
        right: 15%;
        transform: perspective(1000px) rotateX(30deg) rotateZ(15deg);
        animation-delay: 1s;
        clip-path: polygon(0% 0%, 100% 0%, 80% 100%, 20% 100%);
    }

    .shape-3 {
        width: 180px;
        height: 180px;
        bottom: 20%;
        left: 20%;
        transform: perspective(1000px) rotateY(60deg) rotateX(30deg);
        animation-delay: 2s;
        border-radius: 50% 10px;
    }

    .shape-4 {
        width: 120px;
        height: 250px;
        top: 50%;
        left: 5%;
        transform: perspective(1000px) rotateX(60deg) rotateY(30deg);
        animation-delay: 3s;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    }

    .shape-5 {
        width: 160px;
        height: 160px;
        bottom: 10%;
        right: 10%;
        transform: perspective(1000px) rotateX(45deg) rotateZ(45deg);
        animation-delay: 4s;
        border-radius: 30px;
    }

    .shape-6 {
        width: 100px;
        height: 200px;
        top: 30%;
        left: 50%;
        transform: perspective(1000px) rotateY(45deg) rotateX(15deg);
        animation-delay: 5s;
        clip-path: polygon(20% 0%, 80% 0%, 100% 100%, 0% 100%);
    }

    @keyframes float {
        0%, 100% {
            transform: perspective(1000px) rotateX(var(--rx, 45deg)) rotateY(var(--ry, 45deg)) rotateZ(var(--rz, 0deg)) translateY(0px);
        }
        50% {
            transform: perspective(1000px) rotateX(var(--rx, 45deg)) rotateY(var(--ry, 45deg)) rotateZ(var(--rz, 0deg)) translateY(-20px);
        }
    }

    .grid-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: grid-move 20s linear infinite;
    }

    @keyframes grid-move {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    /* Container de connexion */
    .login-container {
        position: relative;
        z-index: 10;
        width: 100%;
        max-width: 450px;
        padding: 0 20px;
    }

    /* Card de connexion */
    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 
            0 32px 64px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: cardAppear 0.6s ease-out;
    }

    @keyframes cardAppear {
        0% {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Header du formulaire */
    .login-header {
        margin-bottom: 32px;
    }

    .logo-container {
        display: flex;
        justify-content: center;
        width: 130px; /* Slightly larger than logo (120px) */
        height: 130px; /* Slightly larger than logo (120px) */
        overflow: visible; /* Ensure content is not clipped */
        margin: 0 auto 32px auto; /* Center the container and add bottom margin */
    }

    .logo-circle {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.4);
        animation: logoFloat 3s ease-in-out infinite;
    }

    .logo-circle i {
        font-size: 36px;
        color: white;
    }

    @keyframes logoFloat {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-5px) rotate(5deg); }
    }

    .welcome-title {
        font-size: 32px;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        letter-spacing: -0.5px;
    }

    .welcome-subtitle {
        font-size: 16px;
        color: #718096;
        margin: 8px 0 0 0;
        font-weight: 500;
    }

    .title-divider {
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 20px auto 0;
        border-radius: 2px;
    }

    /* Styles des formulaires */
    .form-group {
        position: relative;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        z-index: 5;
        color: #a0aec0;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .modern-input {
        width: 100%;
        padding: 16px 16px 16px 48px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        background: white;
        transition: all 0.3s ease;
        color: #2d3748;
    }

    .modern-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    .modern-input:focus + .input-icon,
    .modern-input:focus ~ .input-icon {
        color: #667eea;
    }

    .modern-input.is-invalid {
        border-color: #e53e3e;
        background-color: #fed7d7;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        cursor: pointer;
        color: #a0aec0;
        font-size: 16px;
        transition: color 0.3s ease;
        z-index: 5;
    }

    .password-toggle:hover {
        color: #667eea;
    }

    .error-message {
        color: #e53e3e;
        font-size: 14px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    /* Options du formulaire */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }

    .custom-checkbox {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #4a5568;
        cursor: pointer;
        user-select: none;
    }

    .custom-checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .checkmark {
        height: 20px;
        width: 20px;
        background-color: #e2e8f0;
        border-radius: 4px;
        margin-right: 12px;
        position: relative;
        transition: all 0.3s ease;
        border: 2px solid #e2e8f0;
    }

    .custom-checkbox:hover .checkmark {
        background-color: #cbd5e0;
    }

    .custom-checkbox input:checked ~ .checkmark {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        left: 6px;
        top: 2px;
        width: 6px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .custom-checkbox input:checked ~ .checkmark:after {
        display: block;
    }

    .forgot-link {
        color: #667eea;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .forgot-link:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    /* Bouton de connexion */
    .btn-modern {
        position: relative;
        padding: 16px 24px;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
    }

    .btn-modern:active {
        transform: translateY(0);
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s;
    }

    .btn-modern:hover::before {
        left: 100%;
    }

    .btn-icon {
        transition: transform 0.3s ease;
    }

    .btn-modern:hover .btn-icon {
        transform: translateX(4px);
    }

    /* Lien d'inscription */
    .register-link {
        margin-top: 24px;
    }

    .register-link p {
        color: #718096;
        font-size: 14px;
    }

    .register-link-text {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .register-link-text:hover {
        color: #764ba2;
        text-decoration: underline;
    }

    /* Footer */
    .login-footer {
        position: relative;
        z-index: 10;
    }

    .copyright-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-card {
            padding: 32px 24px;
            margin: 20px;
            border-radius: 20px;
        }

        .welcome-title {
            font-size: 28px;
        }

        .logo-circle {
            width: 70px;
            height: 70px;
        }

        .logo-circle i {
            font-size: 32px;
        }

        .form-options {
            flex-direction: column;
            align-items: flex-start;
        }

        .shape {
            opacity: 0.5;
        }
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 24px 20px;
        }

        .welcome-title {
            font-size: 24px;
        }

        .modern-input {
            padding: 14px 14px 14px 44px;
            font-size: 16px;
        }
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        }
    }

    // Animation d'apparition progressive
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.form-group');
        elements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(() => {
                el.style.transition = 'all 0.5s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100 + (index * 100));
        });
    });
</script>
@endsection