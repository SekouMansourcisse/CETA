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
                    <h1 class="welcome-title">Bienvenue</h1>
                    <p class="company-subtitle">Cabinet d'Architecture</p>
                </div>
                
                <div class="header-divider"></div>
            </div>

            <!-- Formulaire de connexion -->
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <!-- Champ Login restructuré UX -->
                <div class="form-field">
                    <label for="login" class="field-label">
                        <span class="label-text">Identifiant</span>
                        <span class="label-required" aria-label="Champ obligatoire">*</span>
                    </label>
                    <div class="input-wrapper">
                        <div class="input-icon-container">
                            <i class="fas fa-user input-icon" aria-hidden="true"></i>
                        </div>
                        <input id="login" 
                               type="text" 
                               class="form-input @error('login') is-invalid @enderror" 
                               name="login" 
                               value="{{ old('login') }}" 
                               required 
                               autocomplete="username" 
                               autofocus
                               placeholder="Saisissez votre identifiant"
                               aria-describedby="login-help">
                    </div>
                    @error('login')
                        <div class="field-error" role="alert">
                            <i class="fas fa-exclamation-circle error-icon" aria-hidden="true"></i>
                            <span class="error-text">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Champ Mot de passe restructuré UX -->
                <div class="form-field">
                    <label for="password" class="field-label">
                        <span class="label-text">Mot de passe</span>
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
                               autocomplete="current-password"
                               placeholder="Saisissez votre mot de passe"
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

                <!-- Options restructurées UX -->
                <div class="form-options">
                    <div class="checkbox-wrapper">
                        <label class="checkbox-label" for="remember">
                            <input type="checkbox" 
                                   name="remember" 
                                   id="remember" 
                                   class="checkbox-input"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkbox-custom" aria-hidden="true"></span>
                            <span class="checkbox-text">Se souvenir de moi</span>
                        </label>
                    </div>
                </div>

                <!-- Action principale -->
                <div class="form-action">
                    <button type="submit" class="submit-button">
                        <span class="button-text">Se connecter</span>
                        <i class="fas fa-arrow-right button-icon" aria-hidden="true"></i>
                    </button>
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

    /* Arrière-plan avec image bg.jpg et charte graphique logo */
    .background-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        background: 
            linear-gradient(135deg, rgba(102, 102, 153, 0.15) 0%, rgba(101, 101, 154, 0.20) 100%), /* Overlay plus prononcé */
            url('{{ asset("template_assets/img/bg.jpg") }}'), /* Image de fond bg.jpg */
            linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
        background-size: cover, cover, 100% 100%;
        background-position: center, center, center;
        background-attachment: fixed;
        animation: backgroundShift 30s ease-in-out infinite;
    }

    @keyframes backgroundShift {
        0%, 100% {
            background-position: center, center, center;
            filter: hue-rotate(0deg) brightness(1);
        }
        50% {
            background-position: center, center, center;
            filter: hue-rotate(5deg) brightness(1.05);
        }
    }

    /* Overlay gradient - charte graphique logo avec image de fond */
    .overlay-gradient {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 30% 20%, rgba(102, 102, 153, 0.25) 0%, transparent 50%), /* #666699 plus prononcé */
            radial-gradient(circle at 70% 80%, rgba(103, 103, 152, 0.20) 0%, transparent 50%), /* #676798 plus prononcé */
            linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(248, 250, 252, 0.08) 100%);
        backdrop-filter: blur(1px);
        animation: overlayPulse 15s ease-in-out infinite;
    }

    @keyframes overlayPulse {
        0%, 100% { 
            opacity: 1;
            transform: scale(1);
            filter: brightness(1);
        }
        50% { 
            opacity: 0.9;
            transform: scale(1.01);
            filter: brightness(1.1);
        }
    }

    /* Container de connexion - charte graphique logo avec image de fond */
    .login-container {
        position: relative;
        z-index: 10;
        background: rgba(255, 255, 255, 0.92);
        border-radius: 20px;
        box-shadow: 
            0 12px 40px rgba(102, 102, 153, 0.25), /* #666699 plus prononcé */
            0 8px 24px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        width: 100%;
        max-width: 400px;
        padding: 2rem;
        margin: 1rem;
        backdrop-filter: blur(15px);
        border: 1px solid rgba(102, 102, 153, 0.15); /* Bordure plus visible */
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

    /* Card de connexion - contenu interne simplifié */
    .login-card {
        background: transparent; /* Transparent car le container a déjà le fond */
        border-radius: 0; /* Pas de border-radius car géré par le container */
        padding: 0; /* Padding géré par le container */
        box-shadow: none; /* Ombre gérée par le container */
        border: none;
        animation: cardAppear 1s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: visible;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
        width: 100%;
    }

    /* Effet hover - charte graphique logo avec image de fond */
    .login-container:hover {
        transform: translateY(-4px);
        box-shadow: 
            0 20px 60px rgba(102, 102, 153, 0.3), /* #666699 plus prononcé */
            0 12px 32px rgba(103, 103, 152, 0.2), /* #676798 plus prononcé */
            0 8px 24px rgba(0, 0, 0, 0.2);
        border-color: rgba(102, 102, 153, 0.25);
        background: rgba(255, 255, 255, 0.95);
    }

    /* Focus ring - couleurs logo avec image de fond */
    .login-container:focus-within {
        outline: 3px solid rgba(102, 102, 153, 0.7); /* #666699 plus visible */
        outline-offset: 6px;
        box-shadow: 
            0 0 0 3px rgba(102, 102, 153, 0.2),
            0 20px 60px rgba(102, 102, 153, 0.3);
    }

    @keyframes cardAppear {
        0% {
            opacity: 0;
            transform: translateY(40px) scale(0.92) perspective(1000px) rotateX(10deg);
            filter: blur(8px);
        }
        50% {
            opacity: 0.8;
            transform: translateY(-5px) scale(1.02) perspective(1000px) rotateX(-2deg);
            filter: blur(2px);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1) perspective(1000px) rotateX(0deg);
            filter: blur(0px);
        }
    }

    /* ===== HEADER RESTRUCTURÉ AVEC LOGO PROÉMINENT ===== */
    .login-header {
        margin-bottom: 28px;
        padding-bottom: 20px;
        text-align: center;
    }

    /* Section logo centrée et visible */
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
        background: linear-gradient(135deg, #666699 0%, #65659A 50%, #5555AA 100%); /* Palette logo */
        border-radius: 20px;
        box-shadow: 
            0 12px 32px rgba(102, 102, 153, 0.3), /* #666699 */
            0 6px 16px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform-style: preserve-3d;
    }

    .logo-container::before {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        background: linear-gradient(135deg, rgba(102, 102, 153, 0.2) 0%, rgba(103, 103, 152, 0.2) 100%); /* Couleurs logo */
        border-radius: 23px;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .logo-container:hover::before {
        opacity: 1;
    }

    .logo-container:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 
            0 20px 45px rgba(102, 102, 153, 0.4), /* #666699 */
            0 10px 25px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    .main-logo {
        width: 56px !important; /* Logo bien visible */
        height: 56px !important;
        border-radius: 16px !important;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        filter: brightness(1.1) contrast(1.1);
    }

    .logo-container:hover .main-logo {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.5);
    }

    /* Section de bienvenue structurée */
    .welcome-section {
        margin-bottom: 16px;
        text-align: center;
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
        font-size: 26px;
        font-weight: 800;
        color: #000000; /* Noir du logo */
        margin: 0 0 6px 0;
        letter-spacing: -0.3px;
        background: linear-gradient(135deg, #000000 0%, #666699 60%, #5555AA 100%); /* Palette logo */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.15;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .welcome-title::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(102, 102, 153, 0.4), transparent); /* #666699 */
        border-radius: 1px;
    }

    .company-subtitle {
        font-size: 14px;
        color: #676798; /* Violet-gris foncé du logo */
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.8px;
        line-height: 1.3;
        text-transform: uppercase;
        opacity: 0.9;
    }

    /* Divider - charte graphique logo */
    .header-divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #666699 20%, #5555AA 80%, transparent); /* Palette logo */
        margin: 0 auto;
        border-radius: 2px;
        opacity: 0.6;
        position: relative;
    }

    .header-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 8px;
        height: 8px;
        background: radial-gradient(circle, #666699 0%, #5555AA 100%); /* Couleurs logo */
        border-radius: 50%;
        opacity: 0.8;
    }

    /* ===== FORMULAIRE RESTRUCTURÉ SELON PRINCIPES UX ===== */
    
    /* Structure des champs moyens */
    .form-field {
        margin-bottom: 20px; /* Espacement moyen équilibré */
    }

    /* Labels - charte graphique logo */
    .field-label {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #000000; /* Noir du logo pour les labels */
        letter-spacing: 0.1px;
        line-height: 1.3;
    }

    .label-text {
        flex: 1;
    }

    .label-required {
        color: #5555AA; /* Violet bleuté du logo pour l'accent */
        font-size: 13px;
        font-weight: 600;
        line-height: 1;
    }

    /* Container d'input - charte graphique logo */
    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.95);
        border: 1.5px solid rgba(102, 102, 153, 0.2); /* Bordure avec couleur logo */
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 
            0 1px 6px rgba(102, 102, 153, 0.05), /* Ombre avec couleur logo */
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }

    .input-wrapper:focus-within {
        border-color: #666699; /* Couleur principale du logo */
        background: rgba(255, 255, 255, 1);
        box-shadow: 
            0 0 0 3px rgba(102, 102, 153, 0.1), /* #666699 */
            0 8px 24px rgba(102, 102, 153, 0.08),
            0 4px 16px rgba(0, 0, 0, 0.04);
        transform: translateY(-1px);
    }

    /* Icônes moyennes équilibrées */
    .input-icon-container {
        position: absolute;
        left: 15px; /* Position ajustée pour nouveau padding */
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 19px; /* Taille moyenne */
        height: 19px;
    }

    .input-icon {
        color: #666699; /* Couleur principale du logo */
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .input-wrapper:focus-within .input-icon {
        color: #5555AA; /* Violet bleuté du logo au focus */
        transform: scale(1.1);
    }

    /* Input - charte graphique logo */
    .form-input {
        flex: 1;
        padding: 14px 17px 14px 42px;
        border: none;
        background: transparent;
        font-size: 15px;
        font-weight: 500;
        color: #000000; /* Noir du logo pour le texte saisi */
        letter-spacing: 0.1px;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-input::placeholder {
        color: #676798; /* Violet-gris foncé du logo pour placeholder */
        font-weight: 400;
        transition: all 0.3s ease;
        opacity: 0.7;
    }

    .form-input:focus::placeholder {
        color: #65659A; /* Violet-gris proche du logo */
        transform: translateX(4px);
        opacity: 0.5;
    }

    /* États d'erreur */
    .input-wrapper.is-invalid,
    .form-input.is-invalid + .input-wrapper {
        border-color: #ef4444;
        background: rgba(254, 242, 242, 0.95);
        animation: inputShake 0.4s ease-in-out;
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

    @keyframes inputShake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    /* Toggle de visibilité du mot de passe restructuré */
    .password-visibility-toggle {
        position: absolute;
        right: 12px;
        background: none;
        border: none;
        padding: 8px;
        border-radius: 8px;
        cursor: pointer;
        color: #9ca3af;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
    }

    .password-visibility-toggle:hover {
        color: #6366f1;
        background: rgba(99, 102, 241, 0.1);
        transform: scale(1.1);
    }

    .password-visibility-toggle:focus {
        outline: 2px solid rgba(99, 102, 241, 0.6);
        outline-offset: 2px;
    }

    .toggle-icon {
        font-size: 16px;
        transition: all 0.2s ease;
    }

    .error-message {
        color: #e53e3e;
        font-size: 14px;
        margin-top: 8px;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    /* ===== OPTIONS MOYENNES ÉQUILIBRÉES ===== */
    .form-options {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin: 22px 0 20px 0; /* Margins moyennes */
        padding: 14px 0; /* Padding moyen */
    }

    /* Checkbox restructurée avec meilleure accessibilité */
    .checkbox-wrapper {
        display: flex;
        align-items: center;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px; /* Gap réduit pour densité */
        cursor: pointer;
        font-size: 13px; /* Taille compacte */
        font-weight: 500;
        color: #374151;
        user-select: none;
        transition: all 0.2s ease;
        position: relative;
    }

    .checkbox-label:hover {
        color: #1f2937;
    }

    .checkbox-input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        width: 20px;
        height: 20px;
    }

    .checkbox-custom {
        flex-shrink: 0;
        width: 16px; /* Taille compacte selon expertise */
        height: 16px;
        background: rgba(255, 255, 255, 0.9);
        border: 1.5px solid #e5e7eb; /* Border plus fine */
        border-radius: 4px; /* Radius proportionnel */
        transition: all 0.3s ease;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .checkbox-custom::after {
        content: "";
        position: absolute;
        width: 4px; /* Check mark plus petit */
        height: 8px;
        border: solid white;
        border-width: 0 1.5px 1.5px 0; /* Border proportionnelle */
        transform: rotate(45deg) scale(0);
        transition: transform 0.2s ease;
    }

    .checkbox-input:checked + .checkbox-custom {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-color: #6366f1;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .checkbox-input:checked + .checkbox-custom::after {
        transform: rotate(45deg) scale(1);
    }

    .checkbox-input:focus + .checkbox-custom {
        outline: 2px solid rgba(99, 102, 241, 0.6);
        outline-offset: 2px;
    }

    .checkbox-text {
        line-height: 1.4;
    }



    /* ===== ACTIONS RESTRUCTURÉES SELON PRINCIPES UX ===== */
    
    /* Action principale - charte graphique logo */
    .form-action {
        margin: 22px 0 18px 0;
    }

    .submit-button {
        width: 100%;
        padding: 16px 22px;
        border: none;
        border-radius: 14px;
        font-size: 15px;
        font-weight: 700;
        background: linear-gradient(135deg, #666699 0%, #65659A 50%, #5555AA 100%); /* Palette complète du logo */
        color: white;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 11px;
        letter-spacing: 0.2px;
        box-shadow: 
            0 10px 24px rgba(102, 102, 153, 0.25), /* #666699 */
            0 4px 14px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }

    .submit-button:hover {
        transform: translateY(-3px);
        box-shadow: 
            0 16px 36px rgba(102, 102, 153, 0.3), /* #666699 */
            0 6px 20px rgba(0, 0, 0, 0.12);
        background: linear-gradient(135deg, #5555AA 0%, #676798 50%, #65659A 100%); /* Variations du logo */
    }

    .submit-button:active {
        transform: translateY(-1px);
        box-shadow: 
            0 8px 20px rgba(102, 102, 153, 0.25),
            0 3px 12px rgba(0, 0, 0, 0.08);
    }

    .submit-button:focus {
        outline: 2px solid rgba(102, 102, 153, 0.6); /* #666699 */
        outline-offset: 3px;
    }

    .button-text {
        font-weight: 700;
        position: relative;
        z-index: 2;
    }

    .button-icon {
        font-size: 14px; /* Icon plus petite selon densité */
        transition: transform 0.3s ease;
        position: relative;
        z-index: 2;
    }

    .submit-button:hover .button-icon {
        transform: translateX(4px);
    }

    @keyframes buttonPulse {
        0%, 100% { 
            box-shadow: 
                0 20px 60px rgba(99, 102, 241, 0.3),
                0 8px 24px rgba(0, 0, 0, 0.12),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
        50% { 
            box-shadow: 
                0 25px 80px rgba(99, 102, 241, 0.4),
                0 12px 32px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
        z-index: 1;
    }

    .btn-modern:hover::before {
        left: 100%;
    }

    .btn-modern::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
        transition: all 0.4s ease;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        z-index: 0;
    }

    .btn-modern:active::after {
        width: 300px;
        height: 300px;
    }

    .btn-text, .btn-icon {
        position: relative;
        z-index: 2;
    }

    .btn-icon {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 18px;
    }

    .btn-modern:hover .btn-icon {
        transform: translateX(6px) rotate(10deg) scale(1.1);
    }



    /* ===== FOOTER INTÉGRÉ MOYEN ===== */
    .integrated-footer {
        margin-top: 18px; /* Margin moyenne */
        padding-top: 14px; /* Padding moyen */
        border-top: 1px solid rgba(229, 231, 235, 0.4);
        text-align: center;
    }

    .copyright-text {
        color: #676798; /* Violet-gris foncé du logo */
        font-size: 11px;
        margin: 0;
        line-height: 1.3;
        font-weight: 400;
        letter-spacing: 0.1px;
        opacity: 0.8;
    }



    /* Responsive Design - Adaptations */
    @media (max-width: 1200px) {
        .login-container {
            max-width: 380px; /* Taille adaptée sur tablet */
            padding: 1.8rem;
        }
        
        .overlay-gradient {
            background: 
                radial-gradient(circle at 30% 20%, rgba(99, 102, 241, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(167, 139, 250, 0.18) 0%, transparent 50%),
                linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(248, 250, 252, 0.08) 100%);
        }
    }

    @media (max-width: 768px) {
        .login-container {
            max-width: 360px; /* Taille mobile */
            padding: 1.5rem;
            margin: 0.8rem;
        }

        .welcome-title {
            font-size: 22px; /* Taille mobile lisible */
        }

        .company-subtitle {
            font-size: 12px; /* Compact mais lisible */
            letter-spacing: 0.6px;
        }

        .logo-container {
            width: 60px; /* Logo visible sur mobile */
            height: 60px;
        }

        .main-logo {
            width: 46px !important;
            height: 46px !important;
        }

        .login-header {
            margin-bottom: 20px;
            padding-bottom: 16px;
        }

        .logo-section {
            margin-bottom: 16px;
        }

        .form-field {
            margin-bottom: 18px; /* Espacement mobile moyen */
        }

        .form-options {
            justify-content: flex-start;
            margin: 18px 0 16px 0;
            padding: 12px 0;
        }

        .submit-button {
            padding: 14px 20px; /* Padding mobile moyen */
            font-size: 15px;
        }

        .form-input {
            padding: 12px 15px 12px 38px; /* Padding mobile moyen */
            font-size: 15px;
        }

        .input-icon-container {
            left: 13px;
        }

        .field-label {
            font-size: 13px; /* Labels moyens sur mobile */
            margin-bottom: 7px;
        }

        .overlay-gradient {
            animation-duration: 20s;
        }
    }

    @media (max-width: 480px) {
        .login-wrapper {
            padding: 8px;
        }

        .login-container {
            max-width: 320px; /* Petit mobile */
            padding: 1.2rem;
            margin: 0.5rem;
            border-radius: 18px;
        }

        .welcome-title {
            font-size: 20px; /* Compact mais lisible */
        }

        .company-subtitle {
            font-size: 11px; /* Minimal mais lisible */
            letter-spacing: 0.4px;
        }

        .logo-container {
            width: 52px; /* Logo compact mais visible */
            height: 52px;
            border-radius: 16px;
        }

        .main-logo {
            width: 40px !important;
            height: 40px !important;
            border-radius: 12px !important;
        }

        .welcome-title::after {
            width: 60px; /* Divider proportionnel */
        }

        .form-input {
            padding: 9px 12px 9px 32px; /* Très compact */
            font-size: 14px;
            border-radius: 10px;
        }

        .input-icon-container {
            left: 10px;
        }

        .input-icon {
            font-size: 12px;
        }

        .password-visibility-toggle {
            right: 10px;
            padding: 6px;
        }

        .submit-button {
            padding: 11px 16px;
            font-size: 13px;
            border-radius: 10px;
        }

        .field-label {
            font-size: 11px; /* Très petit sur mobile */
        }

        .form-field {
            margin-bottom: 14px; /* Espacement ultra compact */
        }

        .background-image {
            background-attachment: scroll;
        }
        
        .overlay-gradient {
            animation-duration: 25s;
        }
    }

    @media (max-width: 360px) {
        .login-card {
            padding: 24px 18px;
            margin: 10px;
        }

        .welcome-title {
            font-size: 22px;
        }

        .modern-input {
            padding: 14px 14px 14px 42px;
            font-size: 15px;
        }

        .btn-modern {
            padding: 14px 20px;
            font-size: 14px;
        }
    }

    /* Performance optimizations pour mobile */
    @media (max-width: 768px) {
        .login-card:hover {
            transform: translateY(-4px) scale(1.01);
        }

        .btn-modern:hover {
            transform: translateY(-2px) scale(1.02);
            animation: none;
        }

        .modern-input:focus {
            transform: translateY(-1px) scale(1.01);
        }

        .background-image {
            filter: brightness(0.95) contrast(1.05);
        }
    }

    /* Amélioration du contraste pour l'accessibilité */
    @media (prefers-contrast: high) {
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .modern-input {
            border: 2px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.15);
        }

        .welcome-title,
        .welcome-subtitle,
        .form-label {
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
        }
    }

    /* Réduction du mouvement pour les utilisateurs sensibles */
    @media (prefers-reduced-motion: reduce) {
        * {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }

        .login-card:hover,
        .btn-modern:hover,
        .modern-input:focus {
            transform: none;
        }
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

    // Animations et interactions modernes
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'apparition progressive des éléments du formulaire
        const formElements = document.querySelectorAll('.form-field, .form-options, .form-action, .secondary-action, .login-footer');
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

        // Effet de parallax subtil pour l'arrière-plan
        let ticking = false;
        document.addEventListener('mousemove', function(e) {
            if (!ticking && window.innerWidth > 768) {
                requestAnimationFrame(() => {
                    const x = (e.clientX / window.innerWidth - 0.5) * 0.5;
                    const y = (e.clientY / window.innerHeight - 0.5) * 0.5;
                    
                    // Parallax pour l'overlay gradient
                    const overlayGradient = document.querySelector('.overlay-gradient');
                    if (overlayGradient) {
                        overlayGradient.style.transform = `translate(${x * 3}px, ${y * 3}px)`;
                    }
                    
                    // Mouvement subtil de la carte
                    const loginCard = document.querySelector('.login-card');
                    if (loginCard && !loginCard.matches(':hover')) {
                        loginCard.style.transform = `translateY(${y * 2}px) rotateX(${y * 0.5}deg) rotateY(${x * 0.5}deg)`;
                    }
                    
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Animation de vibration sur erreur de validation
        function addErrorAnimation(input) {
            input.addEventListener('animationend', function() {
                this.classList.remove('error-shake');
            });
        }

        inputs.forEach(addErrorAnimation);

        // Amélioration de l'animation du bouton de connexion
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

        // Animation d'ondulation au survol de la carte
        const loginCard = document.querySelector('.login-card');
        if (loginCard) {
            loginCard.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            });

            loginCard.addEventListener('mouseleave', function() {
                this.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            });
        }



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
                        <span>Connexion...</span>
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

        /* Animation des labels au focus */
        .form-label {
            transform-origin: left center;
        }

        /* Optimisations de performance */
        .login-card, .submit-button, .form-input {
            will-change: transform;
        }

        /* États de focus améliorés */
        .form-input:focus,
        .submit-button:focus {
            transform-origin: center;
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