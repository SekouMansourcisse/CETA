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
                    <h1 class="welcome-title">Mot de passe oublié ?</h1>
                    <p class="company-subtitle">Cabinet d'Architecture</p>
                </div>
                
                <div class="header-divider"></div>
            </div>

            <!-- Formulaire de mot de passe oublié -->
            <form method="POST" action="{{ route('password.email') }}" class="login-form">
                @csrf

                <!-- Message de succès -->
                @if (session('status'))
                    <div class="form-field">
                        <div class="success-message">
                            <i class="fas fa-check-circle success-icon" aria-hidden="true"></i>
                            <span class="success-text">{{ session('status') }}</span>
                        </div>
                    </div>
                @endif

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
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               placeholder="exemple@cabinet-architecture.com"
                               aria-describedby="email-help">
                    </div>
                    @error('email')
                        <div class="field-error" role="alert">
                            <i class="fas fa-exclamation-circle error-icon" aria-hidden="true"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Action principale -->
                <div class="form-action">
                    <button type="submit" class="submit-button">
                        <span class="button-text">Envoyer le lien de réinitialisation</span>
                        <i class="fas fa-arrow-right button-icon" aria-hidden="true"></i>
                    </button>
                </div>

                <!-- Action secondaire -->
                <div class="secondary-action">
                    <p class="signup-prompt">
                        Vous vous souvenez ? 
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

    @keyframes containerSlideIn {
        0% {
            opacity: 0;
            transform: translateX(-50px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Card de connexion */
    .login-card {
        background: transparent;
        border-radius: 0;
        padding: 0;
        box-shadow: none;
        border: none;
        animation: cardAppear 1s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: visible;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
        width: 100%;
    }

    @keyframes cardAppear {
        0% {
            opacity: 0;
            transform: translateY(40px) scale(0.92);
            filter: blur(8px);
        }
        50% {
            opacity: 0.8;
            transform: translateY(-5px) scale(1.02);
            filter: blur(2px);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0px);
        }
    }

    /* Header */
    .login-header {
        margin-bottom: 28px;
        padding-bottom: 20px;
        text-align: center;
    }

    .logo-section {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
    }

    .logo-container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, #666699 0%, #65659A 50%, #5555AA 100%);
        border-radius: 20px;
        box-shadow: 
            0 12px 32px rgba(102, 102, 153, 0.3),
            0 6px 16px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .main-logo {
        width: 56px !important;
        height: 56px !important;
        border-radius: 16px !important;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        filter: brightness(1.1) contrast(1.1);
    }

    .welcome-section {
        margin-bottom: 16px;
        text-align: center;
    }

    .welcome-title {
        font-size: 26px;
        font-weight: 800;
        color: #000000;
        margin: 0 0 6px 0;
        letter-spacing: -0.3px;
        background: linear-gradient(135deg, #000000 0%, #666699 60%, #5555AA 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.15;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .company-subtitle {
        font-size: 14px;
        color: #676798;
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.8px;
        line-height: 1.3;
        text-transform: uppercase;
        opacity: 0.9;
    }

    .header-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #666699 20%, #5555AA 80%, transparent);
        margin: 0 auto;
        border-radius: 2px;
        opacity: 0.6;
        position: relative;
    }

    /* Formulaire */
    .form-field {
        margin-bottom: 20px;
    }

    .field-label {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #000000;
        letter-spacing: 0.1px;
        line-height: 1.3;
    }

    .label-text {
        flex: 1;
    }

    .label-required {
        color: #5555AA;
        font-size: 13px;
        font-weight: 600;
        line-height: 1;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.95);
        border: 1.5px solid rgba(102, 102, 153, 0.2);
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 
            0 1px 6px rgba(102, 102, 153, 0.05),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .input-wrapper:focus-within {
        border-color: #666699;
        background: rgba(255, 255, 255, 1);
        box-shadow: 
            0 0 0 3px rgba(102, 102, 153, 0.1),
            0 8px 24px rgba(102, 102, 153, 0.08),
            0 4px 16px rgba(0, 0, 0, 0.04);
        transform: translateY(-1px);
    }

    .input-icon-container {
        position: absolute;
        left: 15px;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 19px;
        height: 19px;
    }

    .input-icon {
        color: #666699;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .input-wrapper:focus-within .input-icon {
        color: #5555AA;
        transform: scale(1.1);
    }

    .form-input {
        flex: 1;
        padding: 14px 17px 14px 42px;
        border: none;
        background: transparent;
        font-size: 15px;
        font-weight: 500;
        color: #000000;
        letter-spacing: 0.1px;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-input::placeholder {
        color: #676798;
        font-weight: 400;
        transition: all 0.3s ease;
        opacity: 0.7;
    }

    .field-error {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
        padding: 8px 12px;
        background: rgba(254, 242, 242, 0.8);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 8px;
        font-size: 13px;
        color: #dc2626;
    }

    .error-icon {
        flex-shrink: 0;
        font-size: 14px;
        color: #ef4444;
    }

    .error-text {
        line-height: 1.4;
        font-weight: 500;
    }

    .success-message {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        background: rgba(240, 253, 244, 0.9);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 10px;
        margin-bottom: 16px;
    }

    .success-icon {
        color: #22c55e;
        font-size: 16px;
        flex-shrink: 0;
    }

    .success-text {
        color: #166534;
        font-size: 14px;
        font-weight: 500;
        line-height: 1.4;
    }

    /* Actions */
    .form-action {
        margin-bottom: 20px;
    }

    .submit-button {
        width: 100%;
        background: linear-gradient(135deg, #666699 0%, #65659A 30%, #5555AA 70%, #676798 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 
            0 8px 20px rgba(102, 102, 153, 0.3),
            0 4px 12px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        letter-spacing: 0.3px;
    }

    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 12px 28px rgba(102, 102, 153, 0.4),
            0 6px 16px rgba(0, 0, 0, 0.15);
        background: linear-gradient(135deg, #5555AA 0%, #676798 30%, #666699 70%, #65659A 100%);
    }

    .button-text {
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .button-icon {
        font-size: 16px;
        transition: transform 0.3s ease;
    }

    .submit-button:hover .button-icon {
        transform: translateX(3px);
    }

    .secondary-action {
        text-align: center;
        margin-bottom: 24px;
    }

    .signup-prompt {
        font-size: 14px;
        color: #676798;
        margin: 0;
        font-weight: 500;
        line-height: 1.5;
    }

    .signup-link {
        color: #666699;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.3s ease;
        padding: 4px 8px;
        border-radius: 6px;
        margin-left: 4px;
        position: relative;
    }

    .signup-link:hover {
        color: #5555AA;
        background: rgba(102, 102, 153, 0.1);
        transform: translateY(-1px);
    }

    .integrated-footer {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid rgba(102, 102, 153, 0.1);
    }

    .copyright-text {
        font-size: 12px;
        color: #676798;
        margin: 0;
        font-weight: 500;
        opacity: 0.8;
        letter-spacing: 0.3px;
    }
</style>

<script>
    // Animation d'apparition progressive au chargement
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'apparition progressive des éléments
        const elements = document.querySelectorAll('.login-card > *');
        elements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                element.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Animation d'écriture du placeholder
        const emailInput = document.getElementById('email');
        if (emailInput) {
            const placeholder = emailInput.getAttribute('placeholder');
            emailInput.setAttribute('placeholder', '');
            
            let i = 0;
            const typeWriter = () => {
                if (i < placeholder.length) {
                    emailInput.setAttribute('placeholder', emailInput.getAttribute('placeholder') + placeholder.charAt(i));
                    i++;
                    setTimeout(typeWriter, 100);
                }
            };
            
            setTimeout(typeWriter, 1000);
        }

        // Gestion du focus amélioré
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.input-wrapper').style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                if (!this.closest('.input-wrapper').matches(':focus-within')) {
                    this.closest('.input-wrapper').style.transform = 'translateY(0)';
                }
            });
        });

        // Gestion des états de chargement du bouton
        const submitButton = document.querySelector('.submit-button');
        const form = document.querySelector('.login-form');
        
        if (form && submitButton) {
            form.addEventListener('submit', function() {
                submitButton.classList.add('loading');
                submitButton.disabled = true;
                
                const buttonText = submitButton.querySelector('.button-text');
                const originalText = buttonText.textContent;
                buttonText.textContent = 'Envoi en cours...';
                
                // Animation du bouton
                submitButton.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    submitButton.style.transform = 'scale(1)';
                }, 150);
            });
        }
    });
</script>

@endsection