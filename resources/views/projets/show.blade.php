@extends('layouts.template')

@section('content')
    <!-- Page Header avec dégradé moderne -->
    <div class="page-header bg-gradient-primary">
        <div class="page-title">
            <h4 class="text-white mb-2">
                <i class="fas fa-project-diagram me-2"></i>Détails du Projet
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-white-50">
                            <i class="fas fa-home me-1"></i>Tableau de Bord
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('projets.index') }}" class="text-white-50">Projets</a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">
                        {{ Str::limit($projet->titre, 30) }}
                    </li>
                </ol>
            </nav>
        </div>
        <div class="page-btn">
            <a href="{{ route('projets.edit', $projet) }}" class="btn btn-warning btn-lg shadow-lg">
                <i class="fas fa-edit me-2"></i> Modifier le projet
            </a>
        </div>
    </div>

    {{-- Hero Card - Détails Principaux --}}
    <div class="card shadow-lg border-0 mb-4 overflow-hidden">
        <div class="card-header bg-white border-0 pb-0">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <h3 class="card-title mb-1 text-primary">{{ $projet->titre }}</h3>
                    <p class="text-muted mb-0">{{ $projet->description }}</p>
                </div>
                @php
                    $statusConfig = [
                        'en_attente' => ['text' => 'En attente', 'color' => 'warning', 'icon' => 'fa-clock'],
                        'en_cours' => ['text' => 'En cours', 'color' => 'primary', 'icon' => 'fa-play-circle'],
                        'termine' => ['text' => 'Terminé', 'color' => 'success', 'icon' => 'fa-check-circle'],
                        'suspendu' => ['text' => 'Suspendu', 'color' => 'danger', 'icon' => 'fa-pause-circle'],
                        'planifie' => ['text' => 'Planifié', 'color' => 'info', 'icon' => 'fa-calendar-alt']
                    ];
                    $config = $statusConfig[$projet->etat] ?? ['text' => 'Inconnu', 'color' => 'secondary', 'icon' => 'fa-question-circle'];
                @endphp
                <div class="text-end">
                    <span class="badge bg-{{ $config['color'] }} px-3 py-2 fs-6">
                        <i class="fas {{ $config['icon'] }} me-2"></i>{{ $config['text'] }}
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body pt-3">
            <div class="row g-4">
                <!-- Colonne Gauche - Informations Projet -->
                <div class="col-xl-8">
                    <div class="row g-4">
                        <!-- Client Card -->
                        <div class="col-md-6">
                            <div class="info-card bg-light-primary p-4 rounded-3 border-start border-primary border-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-lg bg-primary rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="fas fa-user-tie text-white fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 fw-medium">Client</p>
                                        <h5 class="mb-0 text-primary">
                                            {{ $projet->client->societe ?? $projet->client->prenom . ' ' . $projet->client->nom }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Responsable Card -->
                        <div class="col-md-6">
                            <div class="info-card bg-light-success p-4 rounded-3 border-start border-success border-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-lg bg-success rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="fas fa-user-cog text-white fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-muted mb-1 fw-medium">Responsable</p>
                                        <h5 class="mb-0 text-success">
                                            {{ $projet->responsable->prenom }} {{ $projet->responsable->nom }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dates Card -->
                        <div class="col-12">
                            <div class="info-card bg-light-info p-4 rounded-3 border-start border-info border-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-lg bg-info rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="fas fa-calendar-range text-white fs-4"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1 fw-medium">Période du Projet</p>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-light-info text-info me-2 px-3 py-2">
                                                <i class="fas fa-play me-1"></i>{{ $projet->date_debut }}
                                            </span>
                                            <i class="fas fa-arrow-right text-muted mx-2"></i>
                                            <span class="badge bg-light-info text-info px-3 py-2">
                                                <i class="fas fa-flag-checkered me-1"></i>{{ $projet->date_fin }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne Droite - Finances -->
                <div class="col-xl-4">
                    <div class="financial-card bg-gradient-warning text-white rounded-3 p-4 h-100">
                        <h5 class="text-white mb-4">
                            <i class="fas fa-chart-line me-2"></i>Informations Financières
                        </h5>
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-white-50">Budget Prévu</span>
                                <span class="fs-5 fw-bold">{{ number_format($projet->budget_prevu, 2, ',', ' ') }} €</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-white-50">Budget Réalisé</span>
                                <span class="fs-5 fw-bold">{{ number_format($projet->budget_realise, 2, ',', ' ') }} €</span>
                            </div>
                            
                            @php 
                                $progress = $projet->budget_prevu > 0 ? ($projet->budget_realise / $projet->budget_prevu) * 100 : 0;
                                $progressColor = $progress <= 50 ? 'success' : ($progress <= 80 ? 'warning' : 'danger');
                            @endphp
                            
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-{{ $progressColor }}" role="progressbar" 
                                     style="width: {{ min($progress, 100) }}%;" 
                                     aria-valuenow="{{ $progress }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-white-75">{{ number_format($progress, 1) }}% du budget utilisé</small>
                        </div>

                        @if($progress > 100)
                            <div class="alert alert-light border-0 mb-0">
                                <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                <small>Dépassement budgétaire de {{ number_format($progress - 100, 1) }}%</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Documents et Activités --}}
    <div class="card shadow-lg border-0">
        <div class="card-header bg-white border-0">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title mb-0 text-dark">
                    <i class="fas fa-folder-open me-2 text-primary"></i>Documents du Projet
                </h5>
                <span class="badge bg-light-primary text-primary px-3 py-2">
                    {{ collect($activitesByType)->flatten()->count() }} documents
                </span>
            </div>
        </div>

        <div class="card-body">
            @php
                $activityTypes = [
                    'etude' => ['title' => 'Études', 'icon' => 'fa-search', 'color' => 'primary'],
                    'realisation' => ['title' => 'Réalisations', 'icon' => 'fa-hammer', 'color' => 'success'],
                    'expertise' => ['title' => 'Expertises', 'icon' => 'fa-user-graduate', 'color' => 'info'],
                    'autorisation' => ['title' => 'Autorisations', 'icon' => 'fa-certificate', 'color' => 'warning']
                ];
            @endphp

            <!-- Navigation Tabs Moderne -->
            <ul class="nav nav-pills nav-justified mb-4" id="activityTabs" role="tablist">
                @foreach($activityTypes as $type => $config)
                    @if(isset($activitesByType[$type]) && $activitesByType[$type]->isNotEmpty())
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $loop->first ? 'active' : '' }} rounded-pill px-4 py-3 mx-1" 
                                    id="{{ $type }}-tab" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#{{ $type }}-content" 
                                    type="button" 
                                    role="tab" 
                                    aria-controls="{{ $type }}-content" 
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                <i class="fas {{ $config['icon'] }} me-2"></i>{{ $config['title'] }}
                                <span class="badge bg-light text-dark ms-2">
                                    {{ $activitesByType[$type]->flatMap->documents->count() }}
                                </span>
                            </button>
                        </li>
                    @endif
                @endforeach
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="activityTabsContent">
                @foreach($activityTypes as $type => $config)
                    @if(isset($activitesByType[$type]) && $activitesByType[$type]->isNotEmpty())
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                             id="{{ $type }}-content" 
                             role="tabpanel" 
                             aria-labelledby="{{ $type }}-tab">
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-modern">
                                    <thead class="bg-light-{{ $config['color'] }}">
                                        <tr>
                                            <th class="border-0 text-{{ $config['color'] }}">
                                                <i class="fas fa-file me-2"></i>Document
                                            </th>
                                            <th class="border-0 text-{{ $config['color'] }}">Type</th>
                                            <th class="border-0 text-{{ $config['color'] }}">Activité</th>
                                            <th class="border-0 text-{{ $config['color'] }}">Date</th>
                                            <th class="border-0 text-{{ $config['color'] }} text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $documents = $activitesByType[$type]->flatMap->documents;
                                        @endphp
                                        @forelse($documents as $document)
                                            <tr class="document-row">
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        @php
                                                            $extension = pathinfo($document->chemin_acces, PATHINFO_EXTENSION);
                                                            $iconConfig = [
                                                                'jpg' => ['icon' => 'fa-file-image', 'color' => 'success'],
                                                                'jpeg' => ['icon' => 'fa-file-image', 'color' => 'success'],
                                                                'png' => ['icon' => 'fa-file-image', 'color' => 'success'],
                                                                'gif' => ['icon' => 'fa-file-image', 'color' => 'success'],
                                                                'pdf' => ['icon' => 'fa-file-pdf', 'color' => 'danger'],
                                                                'xls' => ['icon' => 'fa-file-excel', 'color' => 'success'],
                                                                'xlsx' => ['icon' => 'fa-file-excel', 'color' => 'success'],
                                                                'doc' => ['icon' => 'fa-file-word', 'color' => 'primary'],
                                                                'docx' => ['icon' => 'fa-file-word', 'color' => 'primary'],
                                                            ];
                                                            
                                                            if ($document->type == 'plan') {
                                                                $fileIcon = ['icon' => 'fa-drafting-compass', 'color' => 'info'];
                                                            } else {
                                                                $fileIcon = $iconConfig[$extension] ?? ['icon' => 'fa-file', 'color' => 'secondary'];
                                                            }
                                                        @endphp
                                                        <div class="file-icon bg-light-{{ $fileIcon['color'] }} text-{{ $fileIcon['color'] }} rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                             style="width: 40px; height: 40px;">
                                                            <i class="fas {{ $fileIcon['icon'] }}"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0">{{ $document->nom }}</h6>
                                                            <small class="text-muted">{{ strtoupper($extension) }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="badge bg-light-secondary text-secondary px-3 py-2">
                                                        {{ ucfirst($document->type) }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-muted">{{ $document->activite->description }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <span class="text-muted">
                                                        <i class="fas fa-calendar me-1"></i>{{ $document->date_upload }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="{{ Storage::url($document->chemin_acces) }}" 
                                                       target="_blank" 
                                                       class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                        <i class="fas fa-eye me-1"></i>Voir
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <div class="empty-state">
                                                        <i class="fas fa-folder-open text-muted display-4 mb-3"></i>
                                                        <p class="text-muted mb-0">Aucun document trouvé pour cette catégorie.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <style>
        /* Styles personnalisés pour améliorer l'apparence */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .bg-gradient-warning {
            background: #1b2850;
        }

        .breadcrumb-custom {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: rgba(255,255,255,0.5);
        }

        .info-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        }

        .financial-card {
            background-color: #1b2850;
            box-shadow: 0 10px 30px rgba(27, 40, 80, 0.3);
        }

        .avatar-lg {
            width: 60px;
            height: 60px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .nav-pills .nav-link {
            color: #6c757d;
            background: #f8f9fa;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .nav-pills .nav-link:hover:not(.active) {
            background: #e9ecef;
            transform: translateY(-1px);
        }

        .table-modern {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-modern thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 1rem;
        }

        .document-row:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }

        .file-icon {
            transition: all 0.2s ease;
        }

        .document-row:hover .file-icon {
            transform: scale(1.1);
        }

        .empty-state i {
            opacity: 0.5;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .badge {
            font-weight: 500;
        }

        .progress {
            border-radius: 10px;
            background-color: rgba(255,255,255,0.2);
        }

        .progress-bar {
            border-radius: 10px;
        }

        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.175) !important;
        }

        /* Background colors for light variants */
        .bg-light-primary { background-color: rgba(13, 110, 253, 0.1) !important; }
        .bg-light-success { background-color: rgba(25, 135, 84, 0.1) !important; }
        .bg-light-info { background-color: rgba(13, 202, 240, 0.1) !important; }
        .bg-light-warning { background-color: rgba(255, 193, 7, 0.1) !important; }
        .bg-light-danger { background-color: rgba(220, 53, 69, 0.1) !important; }
        .bg-light-secondary { background-color: rgba(108, 117, 125, 0.1) !important; }

        /* Text colors */
        .text-white-50 { color: rgba(255,255,255,0.5) !important; }
        .text-white-75 { color: rgba(255,255,255,0.75) !important; }
    </style>
@endsection