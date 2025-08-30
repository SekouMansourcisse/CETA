import ApexCharts from 'apexcharts';
import { chartConfig, donutChartConfig, responsiveConfig, createChartOptions } from './chart-config.js';

document.addEventListener('DOMContentLoaded', function () {
    // Configuration commune pour tous les graphiques donut avec une apparence professionnelle et compacte
    const commonDonutOptions = {
        ...chartConfig,
        ...donutChartConfig,
        chart: {
            ...donutChartConfig.chart,
            height: 200, // Hauteur réduite pour une meilleure visibilité au premier regard
            fontFamily: chartConfig.fontFamily
        },
        colors: chartConfig.defaultColors,
        responsive: responsiveConfig
    };

    // Fonction pour créer un graphique donut avec gestion d'erreur robuste
    function createDonutChart(elementId) {
        const chartElement = document.querySelector(elementId);
        if (!chartElement) {
            console.warn(`Élément ${elementId} non trouvé`);
            return;
        }

        try {
            // Récupération des données depuis les attributs data
            const chartLabels = JSON.parse(chartElement.dataset.labels || '[]');
            const chartSeries = JSON.parse(chartElement.dataset.series || '[]');
            
            // Validation des données
            if (!Array.isArray(chartLabels) || !Array.isArray(chartSeries)) {
                throw new Error('Format de données invalide');
            }
            
            // Si pas de données, afficher un message élégant et compact avec palette du login
            if (chartSeries.length === 0 || chartLabels.length === 0) {
                chartElement.innerHTML = `
                    <div class="text-center text-muted py-3">
                        <div class="empty-chart-icon mb-2" style="color: #676798;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </div>
                        <p class="mb-0 text-sm" style="color: #666699;">Aucune donnée disponible</p>
                        <p class="text-xs opacity-75" style="color: #676798;">Les données apparaîtront ici une fois disponibles</p>
                    </div>
                `;
                return;
            }

            // Création des options du graphique
            const options = {
                ...commonDonutOptions,
                series: chartSeries,
                labels: chartLabels
            };

            // Création et rendu du graphique
            const chart = new ApexCharts(chartElement, options);
            chart.render();

            // Ajouter une classe pour indiquer que le graphique est chargé
            chartElement.classList.add('chart-loaded');
            
            // Stocker la référence du graphique pour le redimensionnement
            chartElement.chart = chart;

        } catch (error) {
            console.error(`Erreur lors de la création du graphique ${elementId}:`, error);
            
            // Affichage d'un message d'erreur élégant et compact avec palette du login
            chartElement.innerHTML = `
                <div class="text-center text-danger py-3">
                    <div class="error-chart-icon mb-2" style="color: #5555AA;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </div>
                    <p class="mb-0 text-sm" style="color: #5555AA;">Erreur de chargement</p>
                    <p class="text-xs opacity-75" style="color: #676798;">Veuillez rafraîchir la page</p>
                </div>
            `;
        }
    }

    // Création de tous les graphiques avec un délai pour assurer le chargement du DOM
    setTimeout(() => {
        createDonutChart('#project-status-chart');
        createDonutChart('#realisation-status-chart');
        createDonutChart('#etude-status-chart');
        createDonutChart('#expertise-status-chart');
        createDonutChart('#autorisation-status-chart');
        createDonutChart('#activity-type-chart');
    }, 100);

    // Gestion du redimensionnement des graphiques
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Redimensionner tous les graphiques chargés
            document.querySelectorAll('.chart-loaded').forEach(element => {
                if (element.chart && typeof element.chart.resize === 'function') {
                    element.chart.resize();
                }
            });
        }, 250); // Délai pour éviter trop de redimensionnements
    });

    // Gestion des erreurs globales
    window.addEventListener('error', function(e) {
        console.error('Erreur globale détectée:', e.error);
    });

    // Gestion des erreurs de promesses non gérées
    window.addEventListener('unhandledrejection', function(e) {
        console.error('Promesse rejetée non gérée:', e.reason);
    });
});