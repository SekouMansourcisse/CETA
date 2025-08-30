@extends('layouts.auth')

@section('content')
<div class="confirm-container">
    <form method="POST" action="{{ route('password.confirm') }}" class="confirm-form">
        @csrf

        <!-- En-tête moderne avec icône -->
        <div class="confirm-header">
            <div class="confirm-icon-wrapper">
                <div class="confirm-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/>
                        <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <div class="confirm-brand-text">
                <h1 class="confirm-title">Confirmer le mot de passe</h1>
                <p class="confirm-subtitle">Pour votre sécurité, veuillez confirmer votre mot de passe avant de continuer</p>
            </div>
            <div class="confirm-divider">
                <span class="divider-dot"></span>
            </div>
        </div>

        <!-- Zone de sécurité -->
        <div class="confirm-security-zone">
            <div class="security-badge">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/>
                </svg>
                <span>Zone sécurisée</span>
            </div>
            <p class="security-text">Cette action nécessite une vérification supplémentaire pour protéger votre compte</p>
        </div>

        <!-- Champ mot de passe -->
        <div class="confirm-field">
            <label class="confirm-field-label" for="password">
                <span class="label-text">Mot de passe actuel</span>
                <span class="label-required">*</span>
            </label>
            <div class="confirm-input-wrapper">
                <div class="input-icon">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="16" r="1" fill="currentColor"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>
                <input id="password" 
                       type="password" 
                       class="confirm-input @error('password') is-invalid @enderror" 
                       name="password" 
                       required 
                       autocomplete="current-password"
                       autofocus
                       placeholder="Entrez votre mot de passe">
                <button type="button" class="confirm-password-toggle" aria-label="Afficher/masquer le mot de passe">
                    <svg class="eye-open" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <svg class="eye-closed" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" stroke="currentColor" stroke-width="2"/>
                        <line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <div class="confirm-error-message">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <line x1="15" y1="9" x2="9" y2="15" stroke="currentColor" stroke-width="2"/>
                        <line x1="9" y1="9" x2="15" y2="15" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <!-- Informations de session -->
        <div class="confirm-session-info">
            <div class="session-icon">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                    <path d="M12 1v6M12 17v6M4.22 4.22l4.24 4.24M15.54 15.54l4.24 4.24M1 12h6M17 12h6M4.22 19.78l4.24-4.24M15.54 8.46l4.24-4.24" stroke="currentColor" stroke-width="2"/>
                </svg>
            </div>
            <div class="session-content">
                <h4 class="session-title">Session sécurisée</h4>
                <ul class="session-list">
                    <li>Votre session expirera automatiquement après inactivité</li>
                    <li>Cette vérification est valable pour les 3 prochaines heures</li>
                    <li>Aucune donnée n'est stockée localement</li>
                </ul>
            </div>
        </div>

        <!-- Actions -->
        <div class="confirm-actions">
            <button type="submit" class="confirm-submit-button">
                <span class="button-content">
                    <svg class="button-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/>
                        <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="button-text">Confirmer le mot de passe</span>
                </span>
                <div class="button-loading">
                    <div class="loading-spinner"></div>
                    <span>Vérification...</span>
                </div>
            </button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="confirm-forgot-link">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="12" y1="17" x2="12.01" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <!-- Footer de sécurité -->
        <div class="confirm-footer">
            <div class="footer-security">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 1l3 9h9l-7 5 3 9-8-6-8 6 3-9-7-5h9z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Connexion sécurisée SSL/TLS</span>
            </div>
        </div>
    </form>
</div>

<style>
/* =====================================================
   CONFIRM PASSWORD - DESIGN MODERNE
   Palette Login: #666699, #65659A, #5555AA, #676798, #000000
   ===================================================== */

:root {
    /* === PALETTE DE COULEURS LOGIN === */
    --confirm-black: #000000;
    --confirm-violet-primary: #666699;
    --confirm-violet-close: #65659A;
    --confirm-violet-blue: #5555AA;
    --confirm-violet-dark: #676798;
    
    /* === VARIATIONS === */
    --confirm-white: #ffffff;
    --confirm-gray-50: #f8fafc;
    --confirm-gray-100: #f1f5f9;
    --confirm-gray-200: #e2e8f0;
    --confirm-gray-400: #94a3b8;
    --confirm-gray-600: #475569;
    --confirm-gray-900: #0f172a;
    
    /* === COULEURS SYSTÈME === */
    --confirm-success: #10b981;
    --confirm-warning: #f59e0b;
    --confirm-error: #ef4444;
    --confirm-info: #3b82f6;
    
    /* === ESPACEMENTS === */
    --confirm-space-xs: 0.5rem;
    --confirm-space-sm: 0.75rem;
    --confirm-space-md: 1rem;
    --confirm-space-lg: 1.5rem;
    --confirm-space-xl: 2rem;
    --confirm-space-2xl: 3rem;
    
    /* === RAYONS === */
    --confirm-radius-sm: 8px;
    --confirm-radius-md: 12px;
    --confirm-radius-lg: 16px;
    --confirm-radius-xl: 20px;
    
    /* === OMBRES === */
    --confirm-shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
    --confirm-shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --confirm-shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    --confirm-shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
}

/* ===== CONTAINER PRINCIPAL ===== */

.confirm-container {
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
    animation: confirmSlideIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes confirmSlideIn {
    0% {
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* ===== EN-TÊTE ===== */

.confirm-header {
    text-align: center;
    margin-bottom: var(--confirm-space-2xl);
}

.confirm-icon-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: var(--confirm-space-lg);
}

.confirm-icon {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, var(--confirm-violet-primary) 0%, var(--confirm-violet-close) 50%, var(--confirm-violet-blue) 100%);
    border-radius: var(--confirm-radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    box-shadow: 
        0 12px 24px rgba(102, 102, 153, 0.3),
        0 4px 8px rgba(0, 0, 0, 0.1);
    animation: iconPulse 2s ease-in-out infinite;
    position: relative;
}

.confirm-icon::before {
    content: '';
    position: absolute;
    top: -3px;
    left: -3px;
    right: -3px;
    bottom: -3px;
    background: linear-gradient(135deg, var(--confirm-violet-blue), var(--confirm-violet-dark));
    border-radius: calc(var(--confirm-radius-lg) + 3px);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
    filter: blur(6px);
}

.confirm-icon:hover::before {
    opacity: 0.6;
}

.confirm-icon svg {
    width: 36px;
    height: 36px;
}

@keyframes iconPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.confirm-brand-text {
    margin-bottom: var(--confirm-space-lg);
}

.confirm-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--confirm-black);
    margin: 0 0 var(--confirm-space-sm) 0;
    line-height: 1.2;
    background: linear-gradient(135deg, var(--confirm-black) 0%, var(--confirm-violet-primary) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.02em;
}

.confirm-subtitle {
    font-size: 1rem;
    color: var(--confirm-violet-primary);
    font-weight: 500;
    margin: 0;
    opacity: 0.9;
    line-height: 1.5;
}

.confirm-divider {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: var(--confirm-space-lg) 0;
}

.confirm-divider::before,
.confirm-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--confirm-violet-primary), transparent);
    opacity: 0.3;
}

.divider-dot {
    width: 8px;
    height: 8px;
    background: var(--confirm-violet-primary);
    border-radius: 50%;
    margin: 0 var(--confirm-space-md);
    opacity: 0.6;
}

/* ===== ZONE DE SÉCURITÉ ===== */

.confirm-security-zone {
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.05), rgba(101, 101, 154, 0.08));
    border: 2px solid rgba(102, 102, 153, 0.15);
    border-radius: var(--confirm-radius-md);
    padding: var(--confirm-space-lg);
    margin-bottom: var(--confirm-space-xl);
    text-align: center;
}

.security-badge {
    display: inline-flex;
    align-items: center;
    gap: var(--confirm-space-sm);
    background: var(--confirm-violet-primary);
    color: white;
    padding: var(--confirm-space-sm) var(--confirm-space-md);
    border-radius: var(--confirm-radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: var(--confirm-space-md);
    box-shadow: var(--confirm-shadow-sm);
}

.security-badge svg {
    width: 16px;
    height: 16px;
}

.security-text {
    font-size: 0.875rem;
    color: var(--confirm-gray-600);
    margin: 0;
    line-height: 1.4;
}

/* ===== CHAMPS DE FORMULAIRE ===== */

.confirm-field {
    margin-bottom: var(--confirm-space-xl);
}

.confirm-field-label {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: var(--confirm-space-sm);
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--confirm-black);
    letter-spacing: 0.1px;
}

.label-text {
    flex: 1;
}

.label-required {
    color: var(--confirm-violet-blue);
    font-weight: 700;
}

.confirm-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    background: var(--confirm-white);
    border: 2px solid rgba(102, 102, 153, 0.15);
    border-radius: var(--confirm-radius-md);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--confirm-shadow-sm);
}

.confirm-input-wrapper:focus-within {
    border-color: var(--confirm-violet-primary);
    box-shadow: 
        0 0 0 4px rgba(102, 102, 153, 0.1),
        var(--confirm-shadow-md);
    transform: translateY(-1px);
}

.input-icon {
    position: absolute;
    left: var(--confirm-space-md);
    z-index: 2;
    color: var(--confirm-violet-primary);
    opacity: 0.7;
    transition: all 0.3s ease;
}

.confirm-input-wrapper:focus-within .input-icon {
    color: var(--confirm-violet-blue);
    opacity: 1;
    transform: scale(1.1);
}

.input-icon svg {
    width: 20px;
    height: 20px;
}

.confirm-input {
    width: 100%;
    padding: var(--confirm-space-md) 3.5rem var(--confirm-space-md) 3.5rem;
    border: none;
    border-radius: var(--confirm-radius-md);
    font-size: 1rem;
    font-weight: 500;
    color: var(--confirm-black);
    background: transparent;
    transition: all 0.3s ease;
    outline: none;
}

.confirm-input::placeholder {
    color: var(--confirm-gray-400);
    font-weight: 400;
}

.confirm-input:focus {
    color: var(--confirm-black);
}

/* ===== TOGGLE MOT DE PASSE ===== */

.confirm-password-toggle {
    position: absolute;
    right: var(--confirm-space-md);
    background: none;
    border: none;
    color: var(--confirm-violet-primary);
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: all 0.3s ease;
    opacity: 0.7;
}

.confirm-password-toggle:hover {
    opacity: 1;
    background: rgba(102, 102, 153, 0.1);
    transform: scale(1.1);
}

.confirm-password-toggle svg {
    width: 20px;
    height: 20px;
}

.confirm-password-toggle .eye-closed {
    display: none;
}

.confirm-password-toggle.active .eye-open {
    display: none;
}

.confirm-password-toggle.active .eye-closed {
    display: block;
}

/* ===== ERREURS ===== */

.confirm-error-message {
    margin-top: var(--confirm-space-sm);
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--confirm-error);
    font-size: 0.875rem;
    font-weight: 500;
    animation: errorShake 0.4s ease-in-out;
}

.confirm-error-message svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

@keyframes errorShake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* ===== INFORMATIONS DE SESSION ===== */

.confirm-session-info {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(59, 130, 246, 0.08));
    border-radius: var(--confirm-radius-md);
    padding: var(--confirm-space-lg);
    margin-bottom: var(--confirm-space-xl);
    border: 1px solid rgba(59, 130, 246, 0.1);
    display: flex;
    align-items: flex-start;
    gap: var(--confirm-space-md);
}

.session-icon {
    flex-shrink: 0;
    width: 20px;
    height: 20px;
    color: var(--confirm-info);
    margin-top: 2px;
}

.session-icon svg {
    width: 100%;
    height: 100%;
}

.session-content {
    flex: 1;
}

.session-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--confirm-info);
    margin: 0 0 var(--confirm-space-sm) 0;
}

.session-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.session-list li {
    position: relative;
    padding-left: 1.5rem;
    margin-bottom: 4px;
    font-size: 0.8125rem;
    color: var(--confirm-gray-600);
    font-weight: 500;
    line-height: 1.4;
}

.session-list li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: var(--confirm-info);
    font-weight: 700;
}

/* ===== ACTIONS ===== */

.confirm-actions {
    display: flex;
    flex-direction: column;
    gap: var(--confirm-space-lg);
    margin-bottom: var(--confirm-space-xl);
}

.confirm-submit-button {
    width: 100%;
    position: relative;
    background: linear-gradient(135deg, var(--confirm-violet-primary) 0%, var(--confirm-violet-close) 50%, var(--confirm-violet-blue) 100%);
    color: white;
    border: none;
    border-radius: var(--confirm-radius-md);
    padding: var(--confirm-space-lg) var(--confirm-space-xl);
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 
        0 10px 20px rgba(102, 102, 153, 0.3),
        0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.confirm-submit-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s ease;
}

.confirm-submit-button:hover::before {
    left: 100%;
}

.confirm-submit-button:hover {
    transform: translateY(-3px);
    box-shadow: 
        0 16px 32px rgba(102, 102, 153, 0.4),
        0 8px 16px rgba(0, 0, 0, 0.15);
    background: linear-gradient(135deg, var(--confirm-violet-blue) 0%, var(--confirm-violet-dark) 50%, var(--confirm-violet-close) 100%);
}

.confirm-submit-button:active {
    transform: translateY(-1px);
}

.confirm-submit-button:focus {
    outline: 2px solid rgba(102, 102, 153, 0.6);
    outline-offset: 3px;
}

.button-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--confirm-space-sm);
    transition: all 0.3s ease;
}

.confirm-submit-button.loading .button-content {
    opacity: 0;
    transform: translateY(20px);
}

.button-icon svg {
    width: 20px;
    height: 20px;
}

.button-loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) translateY(20px);
    display: flex;
    align-items: center;
    gap: var(--confirm-space-sm);
    opacity: 0;
    transition: all 0.3s ease;
}

.confirm-submit-button.loading .button-loading {
    opacity: 1;
    transform: translate(-50%, -50%) translateY(0);
}

.loading-spinner {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.confirm-forgot-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: var(--confirm-space-sm);
    color: var(--confirm-violet-primary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    padding: var(--confirm-space-md) var(--confirm-space-lg);
    border-radius: var(--confirm-radius-sm);
    border: 2px solid rgba(102, 102, 153, 0.15);
    transition: all 0.3s ease;
    background: var(--confirm-white);
}

.confirm-forgot-link:hover {
    color: var(--confirm-violet-blue);
    background: rgba(102, 102, 153, 0.1);
    border-color: rgba(102, 102, 153, 0.3);
    transform: translateY(-2px);
}

.confirm-forgot-link svg {
    width: 16px;
    height: 16px;
}

/* ===== FOOTER ===== */

.confirm-footer {
    text-align: center;
    border-top: 1px solid rgba(102, 102, 153, 0.1);
    padding-top: var(--confirm-space-lg);
}

.footer-security {
    display: inline-flex;
    align-items: center;
    gap: var(--confirm-space-sm);
    color: var(--confirm-gray-600);
    font-size: 0.8125rem;
    font-weight: 500;
}

.footer-security svg {
    width: 16px;
    height: 16px;
    color: var(--confirm-violet-primary);
}

/* ===== RESPONSIVE ===== */

@media (max-width: 480px) {
    .confirm-container {
        margin: 1rem;
        padding: 1.5rem;
        max-width: none;
    }
    
    .confirm-title {
        font-size: 1.75rem;
    }
    
    .confirm-subtitle {
        font-size: 0.9rem;
    }
    
    .confirm-icon {
        width: 64px;
        height: 64px;
    }
    
    .confirm-icon svg {
        width: 32px;
        height: 32px;
    }
    
    .confirm-input {
        padding-left: 3rem;
        padding-right: 3rem;
    }
    
    .input-icon {
        left: var(--confirm-space-sm);
    }
    
    .confirm-password-toggle {
        right: var(--confirm-space-sm);
    }
}

/* ===== ACCESSIBILITY ===== */

@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

@media (prefers-contrast: high) {
    .confirm-container {
        border: 2px solid var(--confirm-black);
    }
    
    .confirm-input-wrapper {
        border-width: 2px;
        border-color: var(--confirm-black);
    }
    
    .confirm-submit-button {
        background: var(--confirm-black);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // === PASSWORD VISIBILITY TOGGLE ===
    const passwordToggle = document.querySelector('.confirm-password-toggle');
    const passwordInput = document.getElementById('password');
    
    if (passwordToggle && passwordInput) {
        passwordToggle.addEventListener('click', function() {
            const isPassword = passwordInput.type === 'password';
            
            passwordInput.type = isPassword ? 'text' : 'password';
            this.classList.toggle('active', isPassword);
            
            // Focus sur l'input après toggle
            setTimeout(() => passwordInput.focus(), 50);
        });
    }
    
    // === FORM SUBMISSION ===
    const form = document.querySelector('.confirm-form');
    const submitButton = document.querySelector('.confirm-submit-button');
    
    if (form && submitButton) {
        form.addEventListener('submit', function(e) {
            const password = passwordInput.value.trim();
            
            if (password.length === 0) {
                e.preventDefault();
                passwordInput.focus();
                
                // Animation d'erreur
                const inputWrapper = passwordInput.parentElement;
                inputWrapper.style.animation = 'errorShake 0.4s ease-in-out';
                setTimeout(() => {
                    inputWrapper.style.animation = '';
                }, 400);
                
                return false;
            }
            
            // Animation de chargement
            submitButton.classList.add('loading');
            submitButton.disabled = true;
            
            // Empêcher la double soumission
            setTimeout(() => {
                if (submitButton.classList.contains('loading')) {
                    submitButton.classList.remove('loading');
                    submitButton.disabled = false;
                }
            }, 10000); // Timeout après 10 secondes
        });
    }
    
    // === KEYBOARD NAVIGATION ===
    if (passwordInput) {
        passwordInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                if (submitButton) {
                    submitButton.click();
                }
            }
        });
        
        // Focus automatique après animation
        setTimeout(() => passwordInput.focus(), 300);
    }
    
    // === SECURITY ANIMATIONS ===
    const securityBadge = document.querySelector('.security-badge');
    if (securityBadge) {
        // Animation de pulsation subtile
        let pulseInterval = setInterval(() => {
            securityBadge.style.transform = 'scale(1.02)';
            setTimeout(() => {
                securityBadge.style.transform = 'scale(1)';
            }, 200);
        }, 3000);
        
        // Arrêter l'animation après 15 secondes
        setTimeout(() => {
            clearInterval(pulseInterval);
        }, 15000);
    }
    
    console.log('✅ Confirm password page initialized');
});
</script>
@endsection
