@extends('layouts.template')

@section('content')
    <!-- Widgets de statistiques en haut - Taille ultra-compacte optimisée -->
    <div class="row mb-2">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget ultra-compact">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('template_assets/img/icons/users1.svg') }}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $stats['total_clients'] }}">{{ $stats['total_clients'] }}</span></h5>
                    <h6>Clients</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash1 ultra-compact">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('template_assets/img/icons/product.svg') }}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $stats['total_projets'] }}">{{ $stats['total_projets'] }}</span></h5>
                    <h6>Projets</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash2 ultra-compact">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('template_assets/img/icons/purchase1.svg') }}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $stats['projets_en_cours'] }}">{{ $stats['projets_en_cours'] }}</span></h5>
                    <h6>Projets en Cours</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget dash3 ultra-compact">
                <div class="dash-widgetimg">
                    <span><img src="{{ asset('template_assets/img/icons/sales1.svg') }}" alt="img"></span>
                </div>
                <div class="dash-widgetcontent">
                    <h5><span class="counters" data-count="{{ $stats['activites_en_cours'] }}">{{ $stats['activites_en_cours'] }}</span></h5>
                    <h6>Activités en Cours</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques visibles au premier regard - Première rangée - Taille ultra-compacte -->
    <div class="row mb-2">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card chart-card ultra-compact h-100">
                <div class="card-header py-1">
                    <h6 class="card-title mb-0">Projets par Statut</h6>
                </div>
                <div class="card-body p-1">
                    <div id="project-status-chart" style="height: 100px;"
                         data-labels="{{ json_encode($projectStatusLabels) }}"
                         data-series="{{ json_encode($projectStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card chart-card ultra-compact h-100">
                <div class="card-header py-1">
                    <h6 class="card-title mb-0">Réalisations par Statut</h6>
                </div>
                <div class="card-body p-1">
                    <div id="realisation-status-chart" style="height: 100px;"
                         data-labels="{{ json_encode($realisationStatusLabels) }}"
                         data-series="{{ json_encode($realisationStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card chart-card ultra-compact h-100">
                <div class="card-header py-1">
                    <h6 class="card-title mb-0">Études par Statut</h6>
                </div>
                <div class="card-body p-1">
                    <div id="etude-status-chart" style="height: 100px;"
                         data-labels="{{ json_encode($etudeStatusLabels) }}"
                         data-series="{{ json_encode($etudeStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques visibles au premier regard - Deuxième rangée - Taille ultra-compacte -->
    <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card chart-card ultra-compact h-100">
                <div class="card-header py-1">
                    <h6 class="card-title mb-0">Expertises par Statut</h6>
                </div>
                <div class="card-body p-1">
                    <div id="expertise-status-chart" style="height: 100px;"
                         data-labels="{{ json_encode($expertiseStatusLabels) }}"
                         data-series="{{ json_encode($expertiseStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card chart-card ultra-compact h-100">
                <div class="card-header py-1">
                    <h6 class="card-title mb-0">Autorisations par Statut</h6>
                </div>
                <div class="card-body p-1">
                    <div id="autorisation-status-chart" style="height: 100px;"
                         data-labels="{{ json_encode($autorisationStatusLabels) }}"
                         data-series="{{ json_encode($autorisationStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card chart-card ultra-compact h-100">
                <div class="card-header py-1">
                    <h6 class="card-title mb-0">Activités par Type</h6>
                </div>
                <div class="card-body p-1">
                    <div id="activity-type-chart" style="height: 100px;"
                         data-labels="{{ json_encode($activityTypeLabels) }}"
                         data-series="{{ json_encode($activityTypeSeries) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles CSS pour l'optimisation ultra-compacte avec palette login et visibilité optimisée -->
    <style>
    /* ===== OPTIMISATION ULTRA-COMPACTE - SANS SCROLLING ===== */
    /* Palette de couleurs du login : #666699, #5555AA, #676798, #65659A */
    
    /* Widgets ultra-compacts avec visibilité optimisée */
    .dash-widget.ultra-compact {
        padding: 8px;
        min-height: 60px;
        margin-bottom: 0;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(102, 102, 153, 0.15);
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(102, 102, 153, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .dash-widget.ultra-compact:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 102, 153, 0.15);
        border-color: rgba(102, 102, 153, 0.25);
    }
    
    .dash-widget.ultra-compact .dash-widgetimg {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, rgba(102, 102, 153, 0.12) 0%, rgba(85, 85, 170, 0.18) 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 6px;
    }
    
    .dash-widget.ultra-compact .dash-widgetimg img {
        width: 18px;
        height: 18px;
        filter: brightness(0) saturate(100%) invert(40%) sepia(20%) saturate(1000%) hue-rotate(220deg) brightness(0.8) contrast(1.2);
    }
    
    .dash-widget.ultra-compact .dash-widgetcontent {
        text-align: center;
    }
    
    .dash-widget.ultra-compact .dash-widgetcontent h5 {
        font-size: 18px;
        margin: 0 0 2px 0;
        line-height: 1.2;
        color: #666699;
        font-weight: 700;
        text-shadow: 0 1px 2px rgba(102, 102, 153, 0.1);
    }
    
    .dash-widget.ultra-compact .dash-widgetcontent h6 {
        font-size: 11px;
        margin: 0;
        line-height: 1.2;
        color: #676798;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        text-shadow: 0 1px 1px rgba(102, 102, 153, 0.1);
    }
    
    /* Cartes de graphiques ultra-compactes avec titres visibles */
    .chart-card.ultra-compact {
        margin-bottom: 0;
        box-shadow: 0 2px 6px rgba(102, 102, 153, 0.08);
        border: 1px solid rgba(102, 102, 153, 0.12);
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }
    
    .chart-card.ultra-compact:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 102, 153, 0.12);
        border-color: rgba(102, 102, 153, 0.2);
    }
    
    .chart-card.ultra-compact .card-header {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid rgba(102, 102, 153, 0.12);
        padding: 6px 10px;
        min-height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .chart-card.ultra-compact .card-header h6 {
        font-size: 11px;
        font-weight: 600;
        color: #666699;
        margin: 0;
        text-align: center;
        letter-spacing: 0.3px;
        line-height: 1.2;
        text-shadow: 0 1px 1px rgba(102, 102, 153, 0.1);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }
    
    .chart-card.ultra-compact .card-body {
        background: #ffffff;
        padding: 6px;
    }
    
    /* Ajustements des marges et espacements optimisés */
    .row.mb-2 {
        margin-bottom: 0.75rem !important;
    }
    
    .row:last-child {
        margin-bottom: 0 !important;
    }
    
    /* Responsivité ultra-optimisée avec visibilité garantie */
    @media (max-width: 1200px) {
        .dash-widget.ultra-compact {
            padding: 7px;
            min-height: 55px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg {
            width: 28px;
            height: 28px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg img {
            width: 16px;
            height: 16px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h5 {
            font-size: 16px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h6 {
            font-size: 10px;
        }
        
        .chart-card.ultra-compact .card-header h6 {
            font-size: 10px;
        }
        
        #project-status-chart,
        #realisation-status-chart,
        #etude-status-chart,
        #expertise-status-chart,
        #autorisation-status-chart,
        #activity-type-chart {
            height: 90px !important;
        }
    }
    
    @media (max-width: 991px) {
        .dash-widget.ultra-compact {
            padding: 6px;
            min-height: 50px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg {
            width: 24px;
            height: 24px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg img {
            width: 14px;
            height: 14px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h5 {
            font-size: 14px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h6 {
            font-size: 9px;
        }
        
        .chart-card.ultra-compact .card-header h6 {
            font-size: 9px;
        }
        
        #project-status-chart,
        #realisation-status-chart,
        #etude-status-chart,
        #expertise-status-chart,
        #autorisation-status-chart,
        #activity-type-chart {
            height: 80px !important;
        }
    }
    
    @media (max-width: 767px) {
        .dash-widget.ultra-compact {
            padding: 5px;
            min-height: 45px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg {
            width: 20px;
            height: 20px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg img {
            width: 12px;
            height: 12px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h5 {
            font-size: 12px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h6 {
            font-size: 8px;
        }
        
        .chart-card.ultra-compact .card-header h6 {
            font-size: 8px;
        }
        
        #project-status-chart,
        #realisation-status-chart,
        #etude-status-chart,
        #expertise-status-chart,
        #autorisation-status-chart,
        #activity-type-chart {
            height: 70px !important;
        }
    }
    
    @media (max-width: 575px) {
        .dash-widget.ultra-compact {
            padding: 4px;
            min-height: 40px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg {
            width: 18px;
            height: 18px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg img {
            width: 10px;
            height: 10px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h5 {
            font-size: 10px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h6 {
            font-size: 7px;
        }
        
        .chart-card.ultra-compact .card-header h6 {
            font-size: 7px;
        }
        
        #project-status-chart,
        #realisation-status-chart,
        #etude-status-chart,
        #expertise-status-chart,
        #autorisation-status-chart,
        #activity-type-chart {
            height: 60px !important;
        }
    }
    
    /* Optimisation pour très petits écrans */
    @media (max-width: 375px) {
        .dash-widget.ultra-compact {
            padding: 3px;
            min-height: 35px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg {
            width: 16px;
            height: 16px;
        }
        
        .dash-widget.ultra-compact .dash-widgetimg img {
            width: 8px;
            height: 8px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h5 {
            font-size: 9px;
        }
        
        .dash-widget.ultra-compact .dash-widgetcontent h6 {
            font-size: 6px;
        }
        
        .chart-card.ultra-compact .card-header h6 {
            font-size: 6px;
        }
        
        #project-status-chart,
        #realisation-status-chart,
        #etude-status-chart,
        #expertise-status-chart,
        #autorisation-status-chart,
        #activity-type-chart {
            height: 50px !important;
        }
    }
    
    /* Ajustements pour l'orientation paysage sur mobile */
    @media (max-width: 991px) and (orientation: landscape) {
        .dash-widget.ultra-compact {
            min-height: 40px;
        }
        
        #project-status-chart,
        #realisation-status-chart,
        #etude-status-chart,
        #expertise-status-chart,
        #autorisation-status-chart,
        #activity-type-chart {
            height: 75px !important;
        }
    }
    
    /* Optimisation de la densité d'affichage équilibrée */
    .col-lg-3.col-sm-6.col-12 {
        margin-bottom: 0.5rem;
    }
    
    .col-lg-4.col-md-6.col-12 {
        margin-bottom: 0.5rem;
    }
    
    /* Ajustement final pour éviter le scrolling */
    .content {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
    
    /* Optimisation des graphiques ApexCharts avec palette login */
    .apexcharts-canvas {
        max-height: 100% !important;
    }
    
    /* Personnalisation des couleurs des graphiques selon la palette login */
    .apexcharts-legend-marker {
        border-color: rgba(102, 102, 153, 0.2) !important;
    }
    
    .apexcharts-tooltip {
        background: rgba(102, 102, 153, 0.95) !important;
        border-color: rgba(85, 85, 170, 0.3) !important;
        color: #ffffff !important;
    }
    
    /* Réduction des marges des cartes */
    .card {
        margin-bottom: 0.5rem;
    }
    
    .card:last-child {
        margin-bottom: 0;
    }
    
    /* Animation subtile pour les widgets */
    .dash-widget.ultra-compact {
        will-change: transform, box-shadow;
    }
    
    /* Focus accessibility avec palette login */
    .dash-widget.ultra-compact:focus,
    .chart-card.ultra-compact:focus {
        outline: 2px solid rgba(102, 102, 153, 0.6);
        outline-offset: 2px;
    }
    
    /* Thème sombre avec palette login */
    @media (prefers-color-scheme: dark) {
        .dash-widget.ultra-compact {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border-color: rgba(102, 102, 153, 0.3);
        }
        
        .chart-card.ultra-compact {
            background: #1a1a2e;
            border-color: rgba(102, 102, 153, 0.3);
        }
        
        .chart-card.ultra-compact .card-header {
            background: linear-gradient(135deg, rgba(102, 102, 153, 0.1) 0%, rgba(85, 85, 170, 0.15) 100%);
        }
        
        .chart-card.ultra-compact .card-body {
            background: #1a1a2e;
        }
    }
    
    /* Réduction du mouvement pour les utilisateurs sensibles */
    @media (prefers-reduced-motion: reduce) {
        .dash-widget.ultra-compact,
        .chart-card.ultra-compact {
            transition: none;
        }
        
        .dash-widget.ultra-compact:hover,
        .chart-card.ultra-compact:hover {
            transform: none;
        }
    }
    </style>

    <!-- Script pour optimiser les graphiques avec la palette login -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuration des couleurs des graphiques selon la palette login
        const loginPalette = {
            primary: '#666699',
            secondary: '#5555AA',
            tertiary: '#676798',
            quaternary: '#65659A',
            accent: '#8b5cf6'
        };
        
        // Fonction pour appliquer la palette aux graphiques existants
        function applyLoginPalette() {
            const charts = document.querySelectorAll('[id$="-chart"]');
            charts.forEach(chart => {
                if (chart.classList.contains('chart-loaded')) {
                    // Les graphiques sont déjà chargés, on peut ajuster les styles
                    const canvas = chart.querySelector('.apexcharts-canvas');
                    if (canvas) {
                        // Appliquer des styles personnalisés si nécessaire
                        canvas.style.borderRadius = '8px';
                    }
                }
            });
        }
        
        // Appliquer la palette au chargement
        applyLoginPalette();
        
        // Observer les changements pour les graphiques qui se chargent dynamiquement
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'childList') {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1 && node.classList && node.classList.contains('chart-loaded')) {
                            applyLoginPalette();
                        }
                    });
                }
            });
        });
        
        // Observer le contenu principal
        const content = document.querySelector('.content');
        if (content) {
            observer.observe(content, { childList: true, subtree: true });
        }
    });
    </script>
@endsection