<div class="header">
    <!-- ===== SECTION GAUCHE - ESPACE LIBRE ===== -->
    <div class="header-left">
        <!-- Espace libre pour équilibrage du layout -->
    </div>

    <!-- ===== SECTION CENTRE - BOUTON MOBILE ===== -->
    <div class="header-center">
        <button id="mobile_btn" class="mobile_btn" type="button" aria-label="Ouvrir le menu de navigation">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
    </div>

    <!-- ===== SECTION DROITE - PROFIL UTILISATEUR ===== -->
    <div class="header-right">
        <div class="user-profile-section">
            <div class="dropdown user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <button class="user-profile-btn" type="button" aria-label="Menu du profil utilisateur">
                    <div class="user-avatar">
                        <img src="{{ asset('template_assets/img/profiles/avator1.jpg') }}" alt="Photo de profil de {{ Auth::user()->prenom }} {{ Auth::user()->nom }}">
                        <span class="status-indicator online" aria-label="En ligne"></span>
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
                        <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                    <i class="fas fa-chevron-down dropdown-arrow" aria-hidden="true"></i>
                </button>
                
                <div class="dropdown-menu user-dropdown-menu">
                    <div class="dropdown-header">
                        <div class="profile-summary">
                            <div class="profile-avatar">
                                <img src="{{ asset('template_assets/img/profiles/avator1.jpg') }}" alt="Photo de profil">
                                <span class="status-indicator online"></span>
                            </div>
                            <div class="profile-details">
                                <h6 class="profile-name">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h6>
                                <p class="profile-role">{{ ucfirst(Auth::user()->role) }}</p>
                              
                            </div>
                        </div>
                    </div>
                    
                    <div class="dropdown-divider"></div>
                    
                    <div class="dropdown-body">
                        <a class="dropdown-item profile-link" href="{{ route('settings.index') }}">
                            <i class="fas fa-user-circle" aria-hidden="true"></i>
                            <span>Mon Profil</span>
                        </a>
                       
                    </div>
                    
                    <div class="dropdown-divider"></div>
                    
                    <div class="dropdown-footer">
                        <a class="dropdown-item logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                            <span>Déconnexion</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ===== HEADER OPTIMISÉ - STRUCTURE SIMPLIFIÉE ===== */
.header {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-bottom: 1px solid rgba(102, 102, 153, 0.1);
    box-shadow: 0 2px 20px rgba(102, 102, 153, 0.08);
    backdrop-filter: blur(10px);
    position: fixed;
    top: 0;
    left: 260px;
    right: 0;
    height: 60px; /* Hauteur optimisée */
    z-index: 1002;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    gap: 16px;
}

/* ===== HEADER LEFT - ESPACE LIBRE ===== */
.header-left {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex: 1; /* Prend l'espace disponible */
}

/* ===== HEADER CENTER - BOUTON MOBILE ===== */
.header-center {
    display: flex;
    align-items: center;
    justify-content: center;
}

.mobile_btn {
    display: none;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.1) 0%, rgba(101, 101, 154, 0.15) 100%);
    border-radius: 10px;
    color: #666699;
    border: 1px solid transparent;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.mobile_btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.05) 0%, rgba(101, 101, 154, 0.08) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 10px;
}

.mobile_btn:hover::before {
    opacity: 1;
}

.mobile_btn:hover {
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.2) 0%, rgba(101, 101, 154, 0.25) 100%);
    color: #5555AA;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(102, 102, 153, 0.15);
    border-color: rgba(102, 102, 153, 0.2);
}

.mobile_btn .bar-icon {
    display: flex;
    flex-direction: column;
    gap: 3px;
    align-items: center;
    position: relative;
    z-index: 2;
}

.mobile_btn .bar-icon span {
    width: 18px;
    height: 2px;
    background: currentColor;
    border-radius: 1px;
    transition: all 0.3s ease;
}

.mobile_btn:hover .bar-icon span:nth-child(1) {
    transform: translateY(5px) rotate(45deg);
}

.mobile_btn:hover .bar-icon span:nth-child(2) {
    opacity: 0;
}

.mobile_btn:hover .bar-icon span:nth-child(3) {
    transform: translateY(-5px) rotate(-45deg);
}

/* ===== HEADER RIGHT - PROFIL UTILISATEUR ===== */
.header-right {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.user-profile-section {
    position: relative;
}

.user-dropdown {
    position: relative;
}

.user-profile-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.05) 0%, rgba(101, 101, 154, 0.08) 100%);
    border: 1px solid transparent;
    border-radius: 14px;
    color: #666699;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    min-width: 180px;
    text-align: left;
}

.user-profile-btn:hover {
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.1) 0%, rgba(101, 101, 154, 0.15) 100%);
    color: #5555AA;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(102, 102, 153, 0.1);
    border-color: rgba(102, 102, 153, 0.15);
}

.user-avatar {
    position: relative;
    flex-shrink: 0;
}

.user-avatar img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(102, 102, 153, 0.2);
    transition: all 0.3s ease;
}

.user-profile-btn:hover .user-avatar img {
    border-color: rgba(102, 102, 153, 0.4);
    transform: scale(1.05);
}

.status-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 2px solid #ffffff;
    transition: all 0.3s ease;
}

.status-indicator.online {
    background: #10b981;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
}

.user-info {
    display: flex;
    flex-direction: column;
    gap: 1px;
    min-width: 0;
    flex: 1;
}

.user-name {
    font-size: 13px;
    font-weight: 600;
    color: inherit;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-role {
    font-size: 11px;
    color: #666699;
    font-weight: 500;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dropdown-arrow {
    font-size: 11px;
    color: #666699;
    transition: transform 0.3s ease;
    flex-shrink: 0;
}

.user-dropdown.show .dropdown-arrow {
    transform: rotate(180deg);
}

/* ===== DROPDOWN MENU ===== */
.user-dropdown-menu {
    background: #ffffff;
    border: 1px solid rgba(102, 102, 153, 0.1);
    border-radius: 18px;
    box-shadow: 0 20px 60px rgba(102, 102, 153, 0.15);
    backdrop-filter: blur(15px);
    padding: 0;
    min-width: 300px;
    margin-top: 10px;
    animation: dropdownSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

@keyframes dropdownSlideIn {
    from {
        opacity: 0;
        transform: translateY(-10px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.dropdown-header {
    padding: 20px 20px 16px;
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.02) 0%, rgba(101, 101, 154, 0.05) 100%);
}

.profile-summary {
    display: flex;
    align-items: center;
    gap: 14px;
}

.profile-avatar {
    position: relative;
    flex-shrink: 0;
}

.profile-avatar img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(102, 102, 153, 0.1);
}

.profile-details {
    flex: 1;
    min-width: 0;
}

.profile-name {
    margin: 0 0 3px 0;
    font-size: 16px;
    font-weight: 700;
    color: #1a1a2e;
    line-height: 1.2;
}

.profile-role {
    margin: 0 0 2px 0;
    font-size: 13px;
    color: #666699;
    font-weight: 600;
    line-height: 1.2;
}

.profile-email {
    margin: 0;
    font-size: 12px;
    color: #8888aa;
    font-weight: 500;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dropdown-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(102, 102, 153, 0.1), transparent);
    margin: 0;
    border: none;
}

.dropdown-body {
    padding: 14px 0;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    color: #666699;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    background: transparent;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, rgba(102, 102, 153, 0.05) 0%, rgba(101, 101, 154, 0.08) 100%);
    color: #5555AA;
    transform: translateX(6px);
}

.dropdown-item i {
    width: 14px;
    font-size: 14px;
    color: #666699;
    transition: color 0.3s ease;
}

.dropdown-item:hover i {
    color: #5555AA;
}

.dropdown-footer {
    padding: 14px 0;
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.02) 0%, rgba(239, 68, 68, 0.05) 100%);
}

.logout-link {
    color: #ef4444 !important;
}

.logout-link:hover {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(239, 68, 68, 0.08) 100%) !important;
    color: #dc2626 !important;
}

.logout-link:hover i {
    color: #dc2626 !important;
}

/* ===== RESPONSIVE DESIGN OPTIMISÉ ===== */

/* Tablettes et petits écrans */
@media (max-width: 1200px) {
    .header {
        padding: 0 16px;
        gap: 12px;
        height: 60px;
    }
    
    .user-profile-btn {
        min-width: 160px;
        padding: 6px 12px;
    }
    
    .user-avatar img {
        width: 32px;
        height: 32px;
    }
    
    .user-name {
        font-size: 12px;
    }
    
    .user-role {
        font-size: 10px;
    }
}

/* Tablettes en mode portrait */
@media (max-width: 991px) {
    .header {
        left: 0;
        padding: 0 12px;
        height: 60px;
        gap: 8px;
    }
    
    .header-left {
        order: 2;
        flex: 1;
        justify-content: center;
    }
    
    .header-center {
        order: 1;
    }
    
    .header-right {
        order: 3;
    }
    
    .mobile_btn {
        display: flex;
        width: 36px;
        height: 36px;
    }
    
    .user-profile-btn {
        min-width: 140px;
        padding: 5px 10px;
        gap: 6px;
    }
    
    .user-avatar img {
        width: 28px;
        height: 28px;
    }
    
    .user-name {
        font-size: 11px;
    }
    
    .user-role {
        font-size: 9px;
    }
    
    .user-dropdown-menu {
        min-width: 260px;
        right: 0;
        left: auto;
    }
}

/* Mobiles en mode paysage */
@media (max-width: 767px) {
    .header {
        padding: 0 8px;
        height: 55px;
        gap: 6px;
    }
    
    .user-profile-btn {
        min-width: 120px;
        padding: 4px 8px;
        gap: 4px;
    }
    
    .user-avatar img {
        width: 24px;
        height: 24px;
    }
    
    .user-name {
        font-size: 10px;
    }
    
    .user-role {
        font-size: 8px;
    }
    
    .user-dropdown-menu {
        min-width: 240px;
        right: -4px;
    }
    
    .mobile_btn {
        width: 32px;
        height: 32px;
    }
    
    .mobile_btn .bar-icon span {
        width: 16px;
        height: 2px;
    }
}

/* Mobiles en mode portrait */
@media (max-width: 575px) {
    .header {
        padding: 0 6px;
        height: 50px;
        gap: 4px;
    }
    
    .user-profile-btn {
        min-width: 100px;
        padding: 3px 6px;
        gap: 3px;
    }
    
    .user-avatar img {
        width: 20px;
        height: 20px;
    }
    
    .user-name {
        font-size: 9px;
    }
    
    .user-role {
        font-size: 7px;
    }
    
    .dropdown-arrow {
        display: none;
    }
    
    .user-dropdown-menu {
        min-width: 220px;
        right: 0;
    }
    
    .mobile_btn {
        width: 28px;
        height: 28px;
    }
    
    .mobile_btn .bar-icon span {
        width: 14px;
        height: 1px;
    }
}

/* Très petits écrans */
@media (max-width: 375px) {
    .header {
        padding: 0 4px;
        height: 45px;
    }
    
    .user-profile-btn {
        min-width: 80px;
        padding: 2px 4px;
        gap: 2px;
    }
    
    .user-avatar img {
        width: 18px;
        height: 18px;
    }
    
    .user-name {
        font-size: 8px;
    }
    
    .user-role {
        font-size: 6px;
    }
    
    .user-dropdown-menu {
        min-width: 200px;
        right: 0;
    }
}

/* ===== ANIMATIONS ET TRANSITIONS ===== */
.header {
    will-change: transform, box-shadow;
}

/* ===== FOCUS ACCESSIBILITÉ ===== */
.mobile_btn:focus,
.user-profile-btn:focus,
.dropdown-item:focus {
    outline: 2px solid rgba(102, 102, 153, 0.6);
    outline-offset: 2px;
}

/* ===== THÈME SOMBRE ===== */
@media (prefers-color-scheme: dark) {
    .header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        border-bottom-color: rgba(102, 102, 153, 0.2);
    }
    
    .mobile_btn,
    .user-profile-btn {
        background: rgba(255, 255, 255, 0.05);
        color: #a0a0a0;
    }
    
    .mobile_btn:hover,
    .user-profile-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }
    
    .user-dropdown-menu {
        background: #1a1a2e;
        border-color: rgba(102, 102, 153, 0.2);
    }
    
    .dropdown-header {
        background: linear-gradient(135deg, rgba(102, 102, 153, 0.1) 0%, rgba(101, 101, 154, 0.15) 100%);
    }
    
    .profile-name {
        color: #ffffff;
    }
    
    .profile-role {
        color: #a0a0a0;
    }
    
    .profile-email {
        color: #8888aa;
    }
    
    .dropdown-item {
        color: #a0a0a0;
    }
    
    .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
    }
    
    .dropdown-item i {
        color: #a0a0a0;
    }
    
    .dropdown-item:hover i {
        color: #ffffff;
    }
}

/* ===== RÉDUCTION DU MOUVEMENT ===== */
@media (prefers-reduced-motion: reduce) {
    .header,
    .mobile_btn,
    .user-profile-btn,
    .dropdown-item,
    .user-dropdown-menu,
    .dropdown-arrow {
        transition: none;
        animation: none;
    }
    
    .mobile_btn:hover .bar-icon span {
        transform: none;
    }
    
    .dropdown-item:hover {
        transform: none;
    }
}

/* ===== ORIENTATION PAYSAGE SUR MOBILE ===== */
@media (max-width: 991px) and (orientation: landscape) {
    .header {
        height: 55px;
    }
    
    .user-profile-btn {
        min-width: 130px;
        padding: 4px 8px;
    }
}

/* ===== HAUTE DENSITÉ PIXELS ===== */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .header {
        border-bottom-width: 0.5px;
    }
    
    .mobile_btn .bar-icon span {
        border-radius: 0.5px;
    }
}

/* ===== AJUSTEMENTS POUR LE CONTENU ===== */
.page-wrapper {
    padding-top: 80px !important; /* Ajusté pour la nouvelle hauteur du header */
}

@media (max-width: 991px) {
    .page-wrapper {
        padding-top: 80px !important;
    }
}

@media (max-width: 767px) {
    .page-wrapper {
        padding-top: 75px !important;
    }
}

@media (max-width: 575px) {
    .page-wrapper {
        padding-top: 70px !important;
    }
}

@media (max-width: 375px) {
    .page-wrapper {
        padding-top: 65px !important;
    }
}
</style>

<script>
// Script pour mettre à jour dynamiquement le titre de la page
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour mettre à jour le titre de la page
    function updatePageTitle() {
        const currentPage = window.location.pathname;
        const pageTitle = document.getElementById('current-page-title');
        const pageSubtitle = document.getElementById('current-page-subtitle');
        
        // Mapping des routes vers les titres
        const pageTitles = {
            '/': { title: 'Tableau de Bord', subtitle: 'Vue d\'ensemble de vos activités' },
            '/clients': { title: 'Gestion Clients', subtitle: 'Gérez vos clients et prospects' },
            '/projets': { title: 'Gestion Projets', subtitle: 'Suivez vos projets en cours' },
            '/activites': { title: 'Gestion Activités', subtitle: 'Planifiez et suivez vos activités' },
            '/depenses': { title: 'Gestion Dépenses', subtitle: 'Contrôlez vos dépenses' },
            '/paiements': { title: 'Gestion Paiements', subtitle: 'Suivez vos recettes' },
            '/documents': { title: 'Gestion Documents', subtitle: 'Organisez vos documents' },
            '/conversations': { title: 'Messagerie', subtitle: 'Communiquez avec vos contacts' },
            '/notifications': { title: 'Notifications', subtitle: 'Restez informé des mises à jour' },
            '/settings': { title: 'Paramètres', subtitle: 'Configurez votre profil' }
        };
        
        // Trouver le titre correspondant
        let foundTitle = pageTitles['/']; // Par défaut
        
        for (const [path, titleInfo] of Object.entries(pageTitles)) {
            if (currentPage.startsWith(path)) {
                foundTitle = titleInfo;
                break;
            }
        }
        
        // Mettre à jour le DOM
        if (pageTitle) pageTitle.textContent = foundTitle.title;
        if (pageSubtitle) pageSubtitle.textContent = foundTitle.subtitle;
    }
    
    // Mettre à jour le titre au chargement
    updatePageTitle();
    
    // Mettre à jour le titre lors des changements de route (pour les SPA)
    if (window.history && window.history.pushState) {
        const originalPushState = window.history.pushState;
        window.history.pushState = function() {
            originalPushState.apply(this, arguments);
            setTimeout(updatePageTitle, 100);
        };
        
        window.addEventListener('popstate', function() {
            setTimeout(updatePageTitle, 100);
        });
    }
});
</script>
