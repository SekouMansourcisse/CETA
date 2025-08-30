@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="dash-widget">
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
            <div class="dash-widget dash1">
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
            <div class="dash-widget dash2">
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
            <div class="dash-widget dash3">
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


    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Répartition des Projets par Statut</h5>
                </div>
                <div class="card-body">
                    <div id="project-status-chart"
                         data-labels="{{ json_encode($projectStatusLabels) }}"
                         data-series="{{ json_encode($projectStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Répartition des Réalisations par Statut</h5>
                </div>
                <div class="card-body">
                    <div id="realisation-status-chart"
                         data-labels="{{ json_encode($realisationStatusLabels) }}"
                         data-series="{{ json_encode($realisationStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Répartition des Études par Statut</h5>
                </div>
                <div class="card-body">
                    <div id="etude-status-chart"
                         data-labels="{{ json_encode($etudeStatusLabels) }}"
                         data-series="{{ json_encode($etudeStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Répartition des Expertises par Statut</h5>
                </div>
                <div class="card-body">
                    <div id="expertise-status-chart"
                         data-labels="{{ json_encode($expertiseStatusLabels) }}"
                         data-series="{{ json_encode($expertiseStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Répartition des Autorisations par Statut</h5>
                </div>
                <div class="card-body">
                    <div id="autorisation-status-chart"
                         data-labels="{{ json_encode($autorisationStatusLabels) }}"
                         data-series="{{ json_encode($autorisationStatusSeries) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection