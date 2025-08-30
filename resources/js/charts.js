import ApexCharts from 'apexcharts';

document.addEventListener('DOMContentLoaded', function () {
    // Donut Chart for Project Status
    if (document.querySelector('#project-status-chart')) {
        var chartElement = document.querySelector('#project-status-chart');
        var labels = JSON.parse(chartElement.dataset.labels);
        var series = JSON.parse(chartElement.dataset.series);

        var donutOptions = {
            chart: {
                height: 350,
                type: 'donut',
            },
            series: series,
            labels: labels,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var donutChart = new ApexCharts(chartElement, donutOptions);
        donutChart.render();
    }

    // Donut Chart for Realisation Status
    if (document.querySelector('#realisation-status-chart')) {
        var chartElement = document.querySelector('#realisation-status-chart');
        var labels = JSON.parse(chartElement.dataset.labels);
        var series = JSON.parse(chartElement.dataset.series);

        var donutOptions = {
            chart: {
                height: 350,
                type: 'donut',
            },
            series: series,
            labels: labels,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var donutChart = new ApexCharts(chartElement, donutOptions);
        donutChart.render();
    }

    // Donut Chart for Etude Status
    if (document.querySelector('#etude-status-chart')) {
        var chartElement = document.querySelector('#etude-status-chart');
        var labels = JSON.parse(chartElement.dataset.labels);
        var series = JSON.parse(chartElement.dataset.series);

        var donutOptions = {
            chart: {
                height: 350,
                type: 'donut',
            },
            series: series,
            labels: labels,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var donutChart = new ApexCharts(chartElement, donutOptions);
        donutChart.render();
    }

    // Donut Chart for Expertise Status
    if (document.querySelector('#expertise-status-chart')) {
        var chartElement = document.querySelector('#expertise-status-chart');
        var labels = JSON.parse(chartElement.dataset.labels);
        var series = JSON.parse(chartElement.dataset.series);

        var donutOptions = {
            chart: {
                height: 350,
                type: 'donut',
            },
            series: series,
            labels: labels,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var donutChart = new ApexCharts(chartElement, donutOptions);
        donutChart.render();
    }

    // Donut Chart for Autorisation Status
    if (document.querySelector('#autorisation-status-chart')) {
        var chartElement = document.querySelector('#autorisation-status-chart');
        var labels = JSON.parse(chartElement.dataset.labels);
        var series = JSON.parse(chartElement.dataset.series);

        var donutOptions = {
            chart: {
                height: 350,
                type: 'donut',
            },
            series: series,
            labels: labels,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };
        var donutChart = new ApexCharts(chartElement, donutOptions);
        donutChart.render();
    }
});