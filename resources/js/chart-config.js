// Configuration avancée pour ApexCharts avec palette de couleurs du login
export const chartConfig = {
    // Configuration des thèmes
    theme: {
        mode: 'light',
        palette: 'palette1'
    },
    
    // Configuration des animations
    animations: {
        enabled: true,
        easing: 'easeinout',
        speed: 600, // Animation plus rapide pour une meilleure expérience
        animateGradually: {
            enabled: true,
            delay: 100 // Délai réduit
        },
        dynamicAnimation: {
            enabled: true,
            speed: 300 // Animation dynamique plus rapide
        }
    },
    
    // Configuration des tooltips
    tooltip: {
        enabled: true,
        theme: 'light',
        style: {
            fontSize: '11px', // Taille réduite pour plus de compacité
            fontFamily: 'Inter, sans-serif'
        }
    },
    
    // Configuration des états
    states: {
        hover: {
            filter: {
                type: 'darken',
                value: 0.1
            }
        },
        active: {
            filter: {
                type: 'darken',
                value: 0.1
            }
        }
    },
    
    // Configuration des polices
    fontFamily: 'Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
    
    // Palette de couleurs du login uniquement
    defaultColors: [
        '#666699', // Violet-gris principal du login
        '#676798', // Violet-gris foncé du login
        '#5555AA', // Violet bleuté du login
        '#65659A', // Violet-gris proche du login
        '#666699', // Répétition pour variété
        '#676798', // Répétition pour variété
        '#5555AA', // Répétition pour variété
        '#65659A', // Répétition pour variété
        '#666699', // Répétition pour variété
        '#676798'  // Répétition pour variété
    ]
};

// Configuration spécifique pour les graphiques donut optimisée pour la visibilité au premier regard
export const donutChartConfig = {
    chart: {
        type: 'donut',
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        pie: {
            donut: {
                size: '65%', // Taille réduite pour plus de compacité
                background: 'transparent',
                labels: {
                    show: true,
                    name: {
                        show: true,
                        fontSize: '12px', // Taille réduite
                        fontWeight: 500,
                        color: '#666699', // Couleur principale du login
                        offsetY: -8 // Offset réduit
                    },
                    value: {
                        show: true,
                        fontSize: '18px', // Taille réduite
                        fontWeight: 700,
                        color: '#5555AA', // Violet bleuté du login
                        offsetY: 0
                    },
                    total: {
                        show: true,
                        label: 'Total',
                        fontSize: '11px', // Taille réduite
                        fontWeight: 600,
                        color: '#676798' // Violet-gris foncé du login
                    }
                }
            }
        }
    },
    legend: {
        position: 'bottom',
        fontSize: '11px', // Taille réduite
        fontWeight: 500,
        markers: {
            width: 8, // Taille réduite
            height: 8, // Taille réduite
            radius: 4, // Rayon réduit
            offsetX: -2 // Offset réduit
        },
        itemMargin: {
            horizontal: 8, // Marge réduite
            vertical: 4 // Marge réduite
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        width: 1.5, // Largeur réduite
        colors: ['#ffffff']
    }
};

// Configuration responsive optimisée pour la visibilité au premier regard
export const responsiveConfig = [
    {
        breakpoint: 1200,
        options: {
            chart: {
                height: 180 // Hauteur réduite
            },
            legend: {
                fontSize: '10px',
                itemMargin: {
                    horizontal: 6,
                    vertical: 3
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '60%'
                    }
                }
            }
        }
    },
    {
        breakpoint: 768,
        options: {
            chart: {
                height: 160 // Hauteur réduite
            },
            legend: {
                fontSize: '9px',
                markers: {
                    width: 6,
                    height: 6
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '55%'
                    }
                }
            }
        }
    }
];

// Fonction utilitaire pour créer des options de graphique
export function createChartOptions(type, data, customOptions = {}) {
    const baseOptions = {
        ...chartConfig,
        ...donutChartConfig,
        series: data.series,
        labels: data.labels,
        colors: chartConfig.defaultColors,
        responsive: responsiveConfig
    };
    
    return {
        ...baseOptions,
        ...customOptions
    };
}
