@extends('layouts.auth')

@section('content')
<!-- Container principal avec arrière-plan image -->
<div class="login-wrapper">
    <!-- Arrière-plan avec image -->
    <div class="background-image">
        <div class="overlay-gradient"></div>
    </div>

    <!-- Conteneur de connexion centré -->
    <div class="login-container">
        <div class="login-card">
            <!-- Header restructuré avec logo proéminent -->
            <div class="login-header">
                <!-- Logo principal centré -->
                <div class="logo-section">
                    <div class="logo-container">
                        <img src="{{ asset('template_assets/img/logo.jpg') }}" alt="Logo Cabinet d'Architecture" class="main-logo">
                    </div>
                </div>
                
                <!-- Texte de bienvenue structuré -->
                <div class="welcome-section">
                    <h1 class="welcome-title">Nouveau mot de passe</h1>
                    <p class="company-subtitle">Cabinet d'Architecture</p>
                </div>
                
                <div class="header-divider"></div>
            </div>

            <!-- Formulaire de reset -->
            <form method="POST" action="{{ route('password.update') }}" class="login-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Champ Email restructuré UX -->
                <div class="form-field">
                    <label for="email" class="field-label">
                        <span class="label-text">Adresse e-mail</span>
                        <span class="label-required" aria-label="Champ obligatoire">*</span>
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon-container">
                            <i class="fas fa-envelope input-icon" aria-hidden="true"></i>
                        </div>
                        <input id="email" 
                               type="email" 
                               class="form-input @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ $email ?? old('email') }}" 
                               required 
                               autocomplete="email" 
                               readonly
                               placeholder="votre.email@exemple.com"
                               aria-describedby="email-help">
                    </div>
                    @error('email')
                        <div class="field-error" role="alert">
                            <i class="fas fa-exclamation-circle error-icon" aria-hidden="true"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Champ Nouveau Mot de passe restructuré UX -->
                <div class="form-field">
                    <label for="password" class="field-label">
                        <span class="label-text">Nouveau mot de passe</span>
                        <span class="label-required" aria-label="Champ obligatoire">*</span>
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon-container">
                            <i class="fas fa-lock input-icon" aria-hidden="true"></i>
                        </div>
                        <input id="password" 
                               type="password" 
                               class="form-input @error('password') is-invalid @enderror" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               placeholder="Entrez votre nouveau mot de passe"
                               aria-describedby="password-help">
                        <button type="button" 
                                class="password-visibility-toggle" 
                                onclick="togglePassword()"
                                aria-label="Afficher/Masquer le mot de passe"
                                tabindex="-1">
                            <i class="fas fa-eye-slash toggle-icon" id="toggleIcon" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="field-error" role="alert">
                            <i class="fas fa-exclamation-circle error-icon" aria-hidden="true"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Champ Confirmation Mot de passe restructuré UX -->
                <div class="form-field">
                    <label for="password-confirm" class="field-label">
                        <span class="label-text">Confirmer le mot de passe</span>
                        <span class="label-required" aria-label="Champ obligatoire">*</span>
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon-container">
                            <i class="fas fa-lock input-icon" aria-hidden="true"></i>
                        </div>
                        <input id="password-confirm" 
                               type="password" 
                               class="form-input" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="Confirmez votre nouveau mot de passe"
                               aria-describedby="password-confirm-help">
                        <button type="button" 
                                class="password-visibility-toggle" 
                                onclick="togglePasswordConfirm()"
                                aria-label="Afficher/Masquer le mot de passe"
                                tabindex="-1">
                            <i class="fas fa-eye-slash toggle-icon" id="toggleIconConfirm" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <!-- Action principale -->
                <div class="form-action">
                    <button type="submit" class="submit-button">
                        <span class="button-text">Réinitialiser le mot de passe</span>
                        <i class="fas fa-arrow-right button-icon" aria-hidden="true"></i>
                    </button>
                </div>

                <!-- Action secondaire -->
                <div class="secondary-action">
                    <p class="signup-prompt">
                        Vous voulez retourner ? 
                        <a href="{{ route('login') }}" 
                           class="signup-link"
                           aria-label="Retour à la connexion">
                            Se connecter
                        </a>
                    </p>
                </div>
            </form>

            <!-- Footer intégré dans le container -->
            <div class="integrated-footer">
                <p class="copyright-text">
                    © 2025 Cabinet d'Architecture. Tous droits réservés.
                </p>
            </div>
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
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: #ffffff;
        overflow: hidden;
    }

    /* Container principal avec arrière-plan image */
    .login-wrapper {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    /* Arrière-plan avec charte graphique logo */
    .background-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        background: 
            linear-gradient(135deg, rgba(102, 102, 153, 0.08) 0%, rgba(101, 101, 154, 0.12) 100%), /* Couleurs logo */
            url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"><defs><linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%23666699;stop-opacity:0.08"/><stop offset="25%" style="stop-color:%2365659A;stop-opacity:0.06"/><stop offset="50%" style="stop-color:%235555AA;stop-opacity:0.05"/><stop offset="75%" style="stop-color:%23676798;stop-opacity:0.06"/><stop offset="100%" style="stop-color:%23666699;stop-opacity:0.08"/></linearGradient><pattern id="grid" width="60" height="60" patternUnits="userSpaceOnUse"><path d="M 60 0 L 0 0 0 60" fill="none" stroke="rgba(102,102,153,0.04)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23bg)"/><rect width="100%" height="100%" fill="url(%23grid)"/></svg>'),
            linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
        background-size: cover, 120px 120px, 100% 100%;
        background-position: center, 0 0, center;
        background-attachment: fixed;
        animation: backgroundShift 30s ease-in-out infinite;
    }

    @keyframes backgroundShift {
        0%, 100% {
            background-position: center, 0 0, center;
            filter: hue-rotate(0deg);
        }
        50% {
            background-position: center, 60px 60px, center;
            filter: hue-rotate(10deg);
        }
    }

    /* Overlay gradient - charte graphique logo */
    .overlay-gradient {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 30% 20%, rgba(102, 102, 153, 0.12) 0%, transparent 50%), /* #666699 */
            radial-gradient(circle at 70% 80%, rgba(103, 103, 152, 0.10) 0%, transparent 50%), /* #676798 */
            linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(248, 250, 252, 0.05) 100%);
        backdrop-filter: blur(0.5px);
        animation: overlayPulse 15s ease-in-out infinite;
    }

    @keyframes overlayPulse {
        0%, 100% { 
            opacity: 1;
            transform: scale(1);
        }
        50% { 
            opacity: 0.8;
            transform: scale(1.02);
        }
    }

    /* Container de connexion - charte graphique logo */
    .login-container {
        position: relative;
        z-index: 10;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 
            0 8px 32px rgba(102, 102, 153, 0.2), /* #666699 avec transparence */
            0 4px 16px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        padding: 2rem;
        margin: 1rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(102, 102, 153, 0.1); /* Bordure subtile avec couleur logo */
        animation: containerSlideIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }


</style>

<script>
    // Fonction pour basculer la visibilité du mot de passe
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

    // Fonction pour basculer la visibilité du mot de passe de confirmation
    function togglePasswordConfirm() {
        const passwordInput = document.getElementById('password-confirm');
        const toggleIcon = document.getElementById('toggleIconConfirm');
        
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

    // Animations et interactions modernes
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'apparition progressive des éléments du formulaire
        const formElements = document.querySelectorAll('.form-field, .form-action, .secondary-action, .integrated-footer');
        formElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px) scale(0.95)';
            setTimeout(() => {
                el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0) scale(1)';
            }, 200 + (index * 100));
        });

        // Animation de typing pour les placeholders
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            const originalPlaceholder = input.placeholder;
            
            input.addEventListener('focus', function() {
                if (this.placeholder === originalPlaceholder) {
                    this.placeholder = '';
                    let i = 0;
                    const typingInterval = setInterval(() => {
                        if (i <= originalPlaceholder.length) {
                            this.placeholder = originalPlaceholder.slice(0, i);
                            i++;
                        } else {
                            clearInterval(typingInterval);
                        }
                    }, 50);
                }
            });

            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.placeholder = originalPlaceholder;
                }
            });
        });

        // Amélioration de l'animation du bouton
        const submitBtn = document.querySelector('.submit-button');
        if (submitBtn) {
            submitBtn.addEventListener('click', function(e) {
                if (!this.classList.contains('loading')) {
                    // Créer un effet de ripple
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: radial-gradient(circle, rgba(255,255,255,0.6) 0%, transparent 70%);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: rippleEffect 0.6s ease-out;
                        pointer-events: none;
                        z-index: 0;
                    `;
                    
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                }
            });
        }

        // Gestion des états de focus améliorée
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.parentElement.classList.remove('focused');
            });
        });

        // Amélioration de l'accessibilité - navigation clavier
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });

        // Feedback visuel pour les états de chargement
        const form = document.querySelector('.login-form');
        if (form) {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('.submit-button');
                if (submitBtn) {
                    submitBtn.classList.add('loading');
                    submitBtn.innerHTML = `
                        <div class="loading-spinner-btn"></div>
                        <span>Traitement...</span>
                    `;
                }
            });
        }

        // Gestion de l'état des inputs pour meilleure UX
        inputs.forEach(input => {
            // Validation en temps réel
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.classList.add('has-content');
                } else {
                    this.classList.remove('has-content');
                }
            });

            // Animation de bordure au focus
            input.addEventListener('focus', function() {
                this.closest('.input-wrapper').classList.add('input-focused');
            });

            input.addEventListener('blur', function() {
                this.closest('.input-wrapper').classList.remove('input-focused');
            });
        });

        // Préchargement des états hover pour performance
        const style = document.createElement('style');
        style.textContent = `
            .login-card, .submit-button, .form-input {
                transform: translateZ(0);
                backface-visibility: hidden;
            }
        `;
        document.head.appendChild(style);

        console.log('✅ Reset password page (like login) initialized');
    });

    // Styles dynamiques pour les animations et accessibilité
    const dynamicStyles = document.createElement('style');
    dynamicStyles.textContent = `
        @keyframes rippleEffect {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        .form-field.focused .field-label {
            color: #1f2937 !important;
            transform: translateY(-2px);
        }
        
        .error-shake {
            animation: inputShake 0.6s ease-in-out !important;
        }

        /* Animations UX pour les inputs */
        .input-wrapper.input-focused {
            transform: scale(1.01);
        }

        .form-input.has-content {
            color: #1f2937;
            font-weight: 600;
        }

        /* Accessibilité - navigation clavier */
        .keyboard-navigation *:focus {
            outline: 2px solid #6366f1 !important;
            outline-offset: 2px !important;
        }

        /* Loading state pour le bouton */
        .submit-button.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .loading-spinner-btn {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Effet de profondeur sur la carte */
        .login-card {
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        /* Optimisations de performance */
        .login-card, .submit-button, .form-input {
            will-change: transform;
        }

        /* Animation subtile pour le logo */
        .main-logo {
            transition: transform 0.3s ease;
        }

        .logo-container:hover .main-logo {
            transform: scale(1.05) rotate(2deg);
        }
    `;
    document.head.appendChild(dynamicStyles);
</script>
@endsection
