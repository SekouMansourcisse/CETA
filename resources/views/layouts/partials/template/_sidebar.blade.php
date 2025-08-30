<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <!-- ===== SECTION LOGO MODERNE ===== -->
        <div class="sidebar-header">
            <div class="sidebar-logo-container">
                <div class="logo-wrapper">
                    <img src="{{ asset('template_assets/img/logo.jpg') }}" alt="Logo Cabinet d'Architecture" class="sidebar-logo">
                    <div class="logo-glow"></div>
                </div>
            </div>
            <div class="sidebar-divider"></div>
        </div>

        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    @can('home.view')
                    <a href="{{ route('home') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/dashboard.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Accueil</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>

                <li class="{{ request()->routeIs('clients.*') ? 'active' : '' }}">
                    @can('clients.view')
                    <a href="{{ route('clients.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/users1.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Clients</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>

                <li class="{{ request()->routeIs('projets.*') ? 'active' : '' }}">
                    @can('projets.view')
                    <a href="{{ route('projets.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/product.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Projets</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>

                @php
                    $isRealisationActive = false;
                    if (request()->routeIs('realisations.index') || (request()->routeIs(['activites.show', 'activites.edit']) && ($activite->type ?? null) === 'realisation')) {
                        $isRealisationActive = true;
                    }
                @endphp
                <li class="{{ $isRealisationActive ? 'active' : '' }}">
                    @can('activites.view')
                    <a href="{{ route('realisations.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/plus-circle.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Réalisation</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>
                
                @php
                    $isEtudeActive = false;
                    if (request()->routeIs('etudes.index') || (request()->routeIs(['activites.show', 'activites.edit']) && ($activite->type ?? null) === 'etude')) {
                        $isEtudeActive = true;
                    }
                @endphp
                <li class="{{ $isEtudeActive ? 'active' : '' }}">
                    @can('activites.view')
                    <a href="{{ route('etudes.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Étude</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>
                
                @php
                    $isExpertiseActive = false;
                    if (request()->routeIs('expertises.index') || (request()->routeIs(['activites.show', 'activites.edit']) && ($activite->type ?? null) === 'expertise')) {
                        $isExpertiseActive = true;
                    }
                @endphp
                <li class="{{ $isExpertiseActive ? 'active' : '' }}">
                    @can('activites.view')
                    <a href="{{ route('expertises.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/search.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Expertise</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>
                
                @php
                    $isAutorisationActive = false;
                    if (request()->routeIs('autorisations.index') || (request()->routeIs(['activites.show', 'activites.edit']) && ($activite->type ?? null) === 'autorisation')) {
                        $isAutorisationActive = true;
                    }
                @endphp
                <li class="{{ $isAutorisationActive ? 'active' : '' }}">
                    @can('activites.view')
                    <a href="{{ route('autorisations.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/plus-circle.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Autorisation</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>

                <li class="{{ request()->routeIs('paiements.*') ? 'active' : '' }}">
                    @can('paiements.view')
                    <a href="{{ route('paiements.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/debitcard.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Paiements</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>

                <li class="{{ request()->routeIs('documents.*') ? 'active' : '' }}">
                    @can('documents.view')
                    <a href="{{ route('documents.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/pdf.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Documents</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>

                <li class="{{ request()->routeIs('conversations.*') ? 'active' : '' }}">
                    @can('conversations.view')
                    <a href="{{ route('conversations.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/notification-bing.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Messagerie</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>

                <li class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    @can('settings.view')
                    <a href="{{ route('settings.index') }}" class="sidebar-link">
                        <div class="sidebar-icon">
                            <img src="{{ asset('template_assets/img/icons/settings.svg') }}" alt="img">
                        </div>
                        <span class="sidebar-text">Paramètres</span>
                        <div class="sidebar-indicator"></div>
                    </a>
                    @endcan
                </li>
            </ul>
        </div>
    </div>
</div>
<style>
/* ===== SIDEBAR MODERNE AVEC PRIORITÉ ABSOLUE ===== */
.sidebar {
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    border-right: 1px solid rgba(102, 102, 153, 0.15);
    margin-top: 0;
    z-index: 1003; /* Priorité absolue sur tout */
    position: fixed;
    top: 0; /* Commence depuis le haut de la page */
    bottom: 0;
    left: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    width: 260px;
    box-shadow: 2px 0 20px rgba(102, 102, 153, 0.08);
    backdrop-filter: blur(10px);
}

@media (max-width: 991px) {
    .sidebar {
        margin-left: -575px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1003; /* Priorité absolue maintenue sur mobile */
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    }
}

@media (max-width: 575px) {
    .sidebar {
        width: 100%;
    }
}

.sidebar .slimScrollDiv {
    width: 260px !important;
    overflow: visible !important;
    background: transparent;
}

@media (max-width: 575px) {
    .sidebar .slimScrollDiv {
        width: 100% !important;
    }
}

/* ===== HEADER LOGO MODERNE ===== */
.sidebar-header {
    padding: 16px 12px 12px; /* Réduit pour plus d'espace */
    text-align: center;
    position: relative;
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.03) 0%, rgba(101, 101, 154, 0.05) 100%);
    border-bottom: 1px solid rgba(102, 102, 153, 0.08);
    margin-top: 0; /* Pas d'espacement pour le header */
}

.sidebar-logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.logo-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px; /* Réduit de 56px à 48px */
    height: 48px; /* Réduit de 56px à 48px */
    background: linear-gradient(135deg, #666699 0%, #65659A 50%, #5555AA 100%);
    border-radius: 14px; /* Réduit de 16px à 14px */
    box-shadow: 
        0 6px 20px rgba(102, 102, 153, 0.25),
        0 3px 10px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform-style: preserve-3d;
    overflow: hidden;
}

.logo-wrapper::before {
    content: '';
    position: absolute;
    top: -2px; /* Réduit de -3px à -2px */
    left: -2px; /* Réduit de -3px à -2px */
    right: -2px; /* Réduit de -3px à -2px */
    bottom: -2px; /* Réduit de -3px à -2px */
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.2) 0%, rgba(103, 103, 152, 0.2) 100%);
    border-radius: 20px; /* Réduit de 23px à 20px */
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.logo-wrapper:hover::before {
    opacity: 1;
}

.logo-wrapper:hover {
    transform: translateY(-3px) scale(1.05); /* Réduit de -4px à -3px */
    box-shadow: 
        0 16px 40px rgba(102, 102, 153, 0.35),
        0 8px 20px rgba(0, 0, 0, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

.sidebar-logo {
    width: 38px !important; /* Réduit de 44px à 38px */
    height: 38px !important; /* Réduit de 44px à 38px */
    border-radius: 10px !important; /* Réduit de 12px à 10px */
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
    filter: brightness(1.1) contrast(1.1);
    position: relative;
    z-index: 2;
}

.logo-wrapper:hover .sidebar-logo {
    transform: scale(1.05);
    border-color: rgba(255, 255, 255, 0.5);
}

.logo-glow {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle, rgba(102, 102, 153, 0.3) 0%, transparent 70%);
    transform: translate(-50%, -50%) scale(0);
    transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 18px; /* Réduit de 20px à 18px */
    opacity: 0;
}

.logo-wrapper:hover .logo-glow {
    transform: translate(-50%, -50%) scale(1.2);
    opacity: 1;
}

.sidebar-divider {
    width: 32px; /* Réduit de 40px à 32px */
    height: 2px;
    background: linear-gradient(90deg, transparent, #666699 20%, #5555AA 80%, transparent);
    margin: 12px auto 0; /* Réduit de 20px à 12px */
    border-radius: 1px;
    opacity: 0.6;
    position: relative;
}

.sidebar-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 4px; /* Réduit de 5px à 4px */
    height: 4px; /* Réduit de 5px à 4px */
    background: radial-gradient(circle, #666699 0%, #5555AA 100%);
    border-radius: 50%;
    opacity: 0.8;
}

.sidebar .sidebar-menu {
    padding: 12px 12px 16px; /* Réduit de 20px 16px 24px à 12px 12px 16px */
}

.sidebar .sidebar-menu > ul > li {
    margin-bottom: 4px; /* Réduit de 8px à 4px */
    position: relative;
}

/* ===== LIENS SIDEBAR MODERNES ===== */
.sidebar-link {
    display: flex;
    align-items: center;
    padding: 10px 12px; /* Réduit de 14px 16px à 10px 12px */
    position: relative;
    color: #676798;
    text-decoration: none;
    border-radius: 10px; /* Réduit de 12px à 10px */
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid transparent;
    overflow: hidden;
}

.sidebar-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.05) 0%, rgba(101, 101, 154, 0.08) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 10px; /* Réduit de 12px à 10px */
}

.sidebar-link:hover::before {
    opacity: 1;
}

.sidebar-link:hover {
    color: #666699;
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(102, 102, 153, 0.2);
    transform: translateY(-1px); /* Réduit de -2px à -1px */
    box-shadow: 
        0 6px 20px rgba(102, 102, 153, 0.15),
        0 3px 12px rgba(0, 0, 0, 0.05);
}

/* ===== ICÔNES SIDEBAR ===== */
.sidebar-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px; /* Réduit de 40px à 32px */
    height: 32px; /* Réduit de 40px à 32px */
    margin-right: 10px; /* Réduit de 12px à 10px */
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.1) 0%, rgba(101, 101, 154, 0.15) 100%);
    border-radius: 8px; /* Réduit de 10px à 8px */
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 2;
}

.sidebar-icon img {
    width: 16px; /* Réduit de 20px à 16px */
    height: 16px; /* Réduit de 20px à 16px */
    filter: brightness(0) saturate(100%) invert(40%) sepia(20%) saturate(1000%) hue-rotate(220deg) brightness(0.8) contrast(0.9);
    transition: all 0.3s ease;
}

.sidebar-link:hover .sidebar-icon {
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.2) 0%, rgba(101, 101, 154, 0.25) 100%);
    transform: scale(1.05);
}

.sidebar-link:hover .sidebar-icon img {
    filter: brightness(0) saturate(100%) invert(35%) sepia(25%) saturate(1200%) hue-rotate(220deg) brightness(0.7) contrast(1.1);
}

/* ===== TEXTE SIDEBAR ===== */
.sidebar-text {
    flex: 1;
    font-size: 13px; /* Réduit de 14px à 13px */
    font-weight: 600;
    color: inherit;
    letter-spacing: 0.1px; /* Réduit de 0.2px à 0.1px */
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

/* ===== INDICATEUR ACTIF ===== */
.sidebar-indicator {
    position: absolute;
    right: 12px; /* Réduit de 16px à 12px */
    top: 50%;
    transform: translateY(-50%);
    width: 5px; /* Réduit de 6px à 5px */
    height: 5px; /* Réduit de 6px à 5px */
    background: linear-gradient(135deg, #666699 0%, #5555AA 100%);
    border-radius: 50%;
    opacity: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 2;
}

/* ===== ÉTAT ACTIF ===== */
.sidebar .sidebar-menu > ul > li.active .sidebar-link {
    background: linear-gradient(135deg, #666699 0%, #65659A 50%, #5555AA 100%);
    color: #ffffff;
    border-color: rgba(102, 102, 153, 0.3);
    box-shadow: 
        0 8px 25px rgba(102, 102, 153, 0.25),
        0 4px 16px rgba(0, 0, 0, 0.08);
    transform: translateY(-1px);
}

.sidebar .sidebar-menu > ul > li.active .sidebar-link::before {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    opacity: 1;
}

.sidebar .sidebar-menu > ul > li.active .sidebar-icon {
    background: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

.sidebar .sidebar-menu > ul > li.active .sidebar-icon img {
    filter: brightness(0) saturate(100%) invert(100%) sepia(0%) saturate(0%) hue-rotate(0deg) brightness(1) contrast(1);
}

.sidebar .sidebar-menu > ul > li.active .sidebar-text {
    color: #ffffff;
    font-weight: 700;
}

.sidebar .sidebar-menu > ul > li.active .sidebar-indicator {
    opacity: 1;
    width: 8px;
    height: 8px;
    background: #ffffff;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

/* ===== HOVER SUR ÉLÉMENTS ACTIFS ===== */
.sidebar .sidebar-menu > ul > li.active .sidebar-link:hover {
    background: linear-gradient(135deg, #5555AA 0%, #676798 50%, #65659A 100%);
    transform: translateY(-2px);
    box-shadow: 
        0 12px 35px rgba(102, 102, 153, 0.3),
        0 6px 20px rgba(0, 0, 0, 0.1);
}

/* ===== ANIMATIONS ET TRANSITIONS ===== */
.sidebar-link {
    transform: translateY(0);
    will-change: transform, box-shadow, background;
}

.sidebar-link:active {
    transform: translateY(0);
    transition: all 0.1s ease;
}

/* ===== RESPONSIVE DESIGN SIMPLIFIÉ ===== */
@media (max-width: 991px) {
    .sidebar-content {
        padding: 18px 0;
    }
    
    .sidebar-logo-simple {
        width: 55px;
        height: 55px;
    }
    
    .sidebar .sidebar-menu {
        padding: 0 14px 18px;
    }
    
    .sidebar-link {
        padding: 12px 14px;
    }

}

@media (max-width: 767px) {
    .sidebar-content {
        padding: 16px 0;
    }
    
    .sidebar-logo-simple {
        width: 50px;
        height: 50px;
    }
    
    .sidebar .sidebar-menu {
        padding: 0 12px 16px;
    }
    
    .sidebar-link {
        padding: 11px 12px;
    }
}

@media (max-width: 575px) {
    .sidebar-content {
        padding: 14px 0;
    }
    
    .sidebar-logo-simple {
        width: 45px;
        height: 45px;
    }
    
    .sidebar .sidebar-menu {
        padding: 0 10px 14px;
    }
    
    .sidebar-link {
        padding: 10px 10px;
    }

}

/* ===== EFFETS DE PROFONDEUR ===== */
.sidebar {
    perspective: 1000px;
}

.sidebar-link {
    transform-style: preserve-3d;
    backface-visibility: hidden;
}

/* ===== SCROLLBAR PERSONNALISÉE ===== */
.sidebar .slimScrollDiv::-webkit-scrollbar {
    width: 4px;
}

.sidebar .slimScrollDiv::-webkit-scrollbar-track {
    background: rgba(102, 102, 153, 0.05);
    border-radius: 2px;
}

.sidebar .slimScrollDiv::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #666699 0%, #5555AA 100%);
    border-radius: 2px;
}

.sidebar .slimScrollDiv::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5555AA 0%, #676798 100%);
}

/* ===== ANIMATION D'ENTRÉE ===== */
.sidebar-header {
    opacity: 0;
    transform: translateY(-20px);
    animation: slideInTop 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.sidebar .sidebar-menu > ul > li {
    opacity: 0;
    transform: translateX(-20px);
    animation: slideInLeft 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
}

.sidebar .sidebar-menu > ul > li:nth-child(1) { animation-delay: 0.2s; }
.sidebar .sidebar-menu > ul > li:nth-child(2) { animation-delay: 0.25s; }
.sidebar .sidebar-menu > ul > li:nth-child(3) { animation-delay: 0.3s; }
.sidebar .sidebar-menu > ul > li:nth-child(4) { animation-delay: 0.35s; }
.sidebar .sidebar-menu > ul > li:nth-child(5) { animation-delay: 0.4s; }
.sidebar .sidebar-menu > ul > li:nth-child(6) { animation-delay: 0.45s; }
.sidebar .sidebar-menu > ul > li:nth-child(7) { animation-delay: 0.5s; }
.sidebar .sidebar-menu > ul > li:nth-child(8) { animation-delay: 0.55s; }
.sidebar .sidebar-menu > ul > li:nth-child(9) { animation-delay: 0.6s; }
.sidebar .sidebar-menu > ul > li:nth-child(10) { animation-delay: 0.65s; }

@keyframes slideInTop {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* ===== FOCUS ACCESSIBILITÉ ===== */
.sidebar-link:focus {
    outline: 2px solid rgba(102, 102, 153, 0.6);
    outline-offset: 2px;
}

/* ===== ÉTATS DE CHARGEMENT ===== */
.sidebar.loading .sidebar-link {
    pointer-events: none;
    opacity: 0.7;
}

/* ===== THÈME SOMBRE (OPTIONNEL) ===== */
@media (prefers-color-scheme: dark) {
    .sidebar {
        background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        border-right-color: rgba(102, 102, 153, 0.3);
    }
    
    .sidebar-header {
        background: linear-gradient(135deg, rgba(102, 102, 153, 0.1) 0%, rgba(101, 101, 154, 0.15) 100%);
        border-bottom-color: rgba(102, 102, 153, 0.2);
    }
    
    .sidebar-link {
        background: rgba(255, 255, 255, 0.05);
        color: #a0a0a0;
    }
    
    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }
    
    .sidebar-icon {
        background: rgba(102, 102, 153, 0.2);
    }
    

}

/* ===== RÉDUCTION DU MOUVEMENT ===== */
@media (prefers-reduced-motion: reduce) {
    .sidebar-link,
    .sidebar-icon,
    .sidebar-indicator,
    .logo-wrapper {
        transition: none;
        animation: none;
    }
    
    .sidebar-header,
    .sidebar .sidebar-menu > ul > li {
        animation: none;
        opacity: 1;
        transform: none;
    }
}
</style>
