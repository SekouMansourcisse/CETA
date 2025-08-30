@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $projet->titre }}</h4>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projets.index') }}">Projets</a></li>
                <li class="breadcrumb-item active">Projet #{{ $projet->id }}</li>
            </ul>
        </div>
        <div class="page-btn">
            <a href="{{ route('projets.edit', $projet) }}" class="btn btn-info me-2">
                <img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="img" class="me-1">Modifier
            </a>
            <a href="{{ route('projets.index') }}" class="btn btn-secondary">
                <img src="{{ asset('template_assets/img/icons/arrow-left.svg') }}" alt="img" class="me-1">Retour
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succès !</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Informations générales du projet -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="project-title mb-3">{{ $projet->titre }}</h5>
                            <p class="text-muted mb-3">{{ $projet->description }}</p>
                            
                            <div class="project-meta">
                                <div class="meta-item">
                                    <span class="meta-label">Date de début:</span>
                                    <span class="meta-value">{{ $projet->date_debut ? $projet->date_debut->format('d/m/Y') : 'Non définie' }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Date de fin:</span>
                                    <span class="meta-value">{{ $projet->date_fin ? $projet->date_fin->format('d/m/Y') : 'Non définie' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="project-budget">
                                <div class="budget-item">
                                    <span class="budget-label">Budget Prévu</span>
                                    <span class="budget-amount">{{ number_format($projet->budget_prevu, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="budget-item">
                                    <span class="budget-label">Budget Réalisé</span>
                                    <span class="budget-amount">{{ number_format($projet->budget_realise, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="progress mt-3">
                                    <div class="progress-bar bg-success" style="width: {{ $projet->budget_prevu > 0 ? min(($projet->budget_realise / $projet->budget_prevu) * 100, 100) : 0 }}%"></div>
                                </div>
                                <small class="text-muted">{{ $projet->budget_prevu > 0 ? round(($projet->budget_realise / $projet->budget_prevu) * 100, 1) : 0 }}% réalisé</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-3">Informations Client</h6>
                    <div class="client-info">
                        <div class="client-name">
                            <strong>{{ $projet->client->societe ?? $projet->client->prenom . ' ' . $projet->client->nom }}</strong>
                        </div>
                        <div class="client-details">
                            <p class="mb-1"><i class="fas fa-phone text-muted me-2"></i>{{ $projet->client->telephone }}</p>
                            <p class="mb-1"><i class="fas fa-envelope text-muted me-2"></i>{{ $projet->client->email }}</p>
                            <p class="mb-3"><i class="fas fa-map-marker-alt text-muted me-2"></i>{{ $projet->client->adresse }}</p>
                        </div>
                    </div>
                    
                    @php
                        $statusConfig = [
                            'en_attente' => ['text' => 'En attente', 'class' => 'bg-warning'],
                            'en_cours' => ['text' => 'En cours', 'class' => 'bg-info'],
                            'termine' => ['text' => 'Terminé', 'class' => 'bg-success'],
                            'suspendu' => ['text' => 'Suspendu', 'class' => 'bg-danger'],
                            'planifie' => ['text' => 'Planifié', 'class' => 'bg-primary']
                        ];
                        $config = $statusConfig[$projet->etat] ?? ['text' => 'Inconnu', 'class' => 'bg-secondary'];
                    @endphp
                    
                    <span class="badge {{ $config['class'] }} fs-6 px-3 py-2">{{ $config['text'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Étude -->
    <div class="activity-section mb-5">
        <div class="section-header">
            <h4 class="section-title">Étude :</h4>
        </div>
        
        <div class="row">
            @php
                $etudeActivite = $activites->where('type', 'etude')->first();
                $documentTypes = [
                    'demande_client' => ['name' => 'Demande Client', 'icon' => 'file-text', 'status' => 'Demande signée par le client'],
                    'devis_client' => ['name' => 'Devis Client', 'icon' => 'camera', 'status' => 'Demande signée par le client'],
                    'reception' => ['name' => 'Réception', 'icon' => 'calendar', 'status' => 'En attente D\'analyse'],
                    'resultat_analyse' => ['name' => 'Résultat d\'Analyse', 'icon' => 'bar-chart', 'status' => 'Résultat pret']
                ];
            @endphp
            
            @foreach($documentTypes as $type => $config)
                @php
                    $documents = $etudeActivite ? $etudeActivite->documents->where('type', $type) : collect();
                    $hasDocuments = $documents->count() > 0;
                @endphp
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="document-card {{ $hasDocuments ? 'has-documents' : 'no-documents' }}" 
                         onclick="openDocumentModal('etude', '{{ $type }}', '{{ $config['name'] }}')">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="document-icon mb-3">
                                    @if($config['icon'] == 'file-text')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#file-text') }}"></use>
                                        </svg>
                                    @elseif($config['icon'] == 'camera')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#camera') }}"></use>
                                        </svg>
                                    @elseif($config['icon'] == 'calendar')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#calendar') }}"></use>
                                        </svg>
                                    @else
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#bar-chart') }}"></use>
                                        </svg>
                                    @endif
                                </div>
                                
                                <h6 class="document-title mb-2">{{ $config['name'] }}</h6>
                                
                                <div class="document-status">
                                    @if($hasDocuments)
                                        <span class="badge bg-success mb-2">{{ $documents->count() }} document(s)</span>
                                    @else
                                        <span class="badge bg-secondary mb-2">Aucun document</span>
                                    @endif
                                </div>
                                
                                <p class="document-status-text text-primary small">{{ $config['status'] }}</p>
                                
                                @if($hasDocuments)
                                    <div class="document-actions mt-3">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Voir les documents">
                                            <img src="{{ asset('template_assets/img/icons/eye.svg') }}" alt="Voir" width="16">
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Ajouter un document">
                                            <img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="Ajouter" width="16">
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Section Réalisation -->
    <div class="activity-section mb-5">
        <div class="section-header">
            <h4 class="section-title">Réalisation :</h4>
        </div>
        
        <div class="row">
            @php
                $realisationActivite = $activites->where('type', 'realisation')->first();
                $documentTypes = [
                    'demande_client' => ['name' => 'Demande Client', 'icon' => 'file-text', 'status' => 'Demande signée par le client'],
                    'devis_client' => ['name' => 'Devis Client', 'icon' => 'camera', 'status' => 'Demande signée par le client'],
                    'reception' => ['name' => 'Réception', 'icon' => 'calendar', 'status' => 'En attente D\'analyse'],
                    'resultat_analyse' => ['name' => 'Résultat d\'Analyse', 'icon' => 'bar-chart', 'status' => 'Résultat pret']
                ];
            @endphp
            
            @foreach($documentTypes as $type => $config)
                @php
                    $documents = $realisationActivite ? $realisationActivite->documents->where('type', $type) : collect();
                    $hasDocuments = $documents->count() > 0;
                @endphp
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="document-card {{ $hasDocuments ? 'has-documents' : 'no-documents' }}" 
                         onclick="openDocumentModal('realisation', '{{ $type }}', '{{ $config['name'] }}')">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="document-icon mb-3">
                                    @if($config['icon'] == 'file-text')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#file-text') }}"></use>
                                        </svg>
                                    @elseif($config['icon'] == 'camera')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#camera') }}"></use>
                                        </svg>
                                    @elseif($config['icon'] == 'calendar')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#calendar') }}"></use>
                                        </svg>
                                    @else
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#bar-chart') }}"></use>
                                        </svg>
                                    @endif
                                </div>
                                
                                <h6 class="document-title mb-2">{{ $config['name'] }}</h6>
                                
                                <div class="document-status">
                                    @if($hasDocuments)
                                        <span class="badge bg-success mb-2">{{ $documents->count() }} document(s)</span>
                                    @else
                                        <span class="badge bg-secondary mb-2">Aucun document</span>
                                    @endif
                                </div>
                                
                                <p class="document-status-text text-primary small">{{ $config['status'] }}</p>
                                
                                @if($hasDocuments)
                                    <div class="document-actions mt-3">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Voir les documents">
                                            <img src="{{ asset('template_assets/img/icons/eye.svg') }}" alt="Voir" width="16">
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Ajouter un document">
                                            <img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="Ajouter" width="16">
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Section Expertise -->
    <div class="activity-section mb-5">
        <div class="section-header">
            <h4 class="section-title">Expertise :</h4>
        </div>
        
        <div class="row">
            @php
                $expertiseActivite = $activites->where('type', 'expertise')->first();
                $documentTypes = [
                    'rapport_expertise' => ['name' => 'Rapport d\'Expertise', 'icon' => 'file-text', 'status' => 'Rapport terminé'],
                    'photos_terrain' => ['name' => 'Photos Terrain', 'icon' => 'camera', 'status' => 'Photos disponibles'],
                    'mesures' => ['name' => 'Mesures', 'icon' => 'calendar', 'status' => 'Mesures effectuées'],
                    'conclusions' => ['name' => 'Conclusions', 'icon' => 'bar-chart', 'status' => 'Conclusions prêtes']
                ];
            @endphp
            
            @foreach($documentTypes as $type => $config)
                @php
                    $documents = $expertiseActivite ? $expertiseActivite->documents->where('type', $type) : collect();
                    $hasDocuments = $documents->count() > 0;
                @endphp
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="document-card {{ $hasDocuments ? 'has-documents' : 'no-documents' }}" 
                         onclick="openDocumentModal('expertise', '{{ $type }}', '{{ $config['name'] }}')">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="document-icon mb-3">
                                    @if($config['icon'] == 'file-text')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#file-text') }}"></use>
                                        </svg>
                                    @elseif($config['icon'] == 'camera')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#camera') }}"></use>
                                        </svg>
                                    @elseif($config['icon'] == 'calendar')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#calendar') }}"></use>
                                        </svg>
                                    @else
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#bar-chart') }}"></use>
                                        </svg>
                                    @endif
                                </div>
                                
                                <h6 class="document-title mb-2">{{ $config['name'] }}</h6>
                                
                                <div class="document-status">
                                    @if($hasDocuments)
                                        <span class="badge bg-success mb-2">{{ $documents->count() }} document(s)</span>
                                    @else
                                        <span class="badge bg-secondary mb-2">Aucun document</span>
                                    @endif
                                </div>
                                
                                <p class="document-status-text text-primary small">{{ $config['status'] }}</p>
                                
                                @if($hasDocuments)
                                    <div class="document-actions mt-3">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Voir les documents">
                                            <img src="{{ asset('template_assets/img/icons/eye.svg') }}" alt="Voir" width="16">
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Ajouter un document">
                                            <img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="Ajouter" width="16">
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Section Autorisation -->
    <div class="activity-section mb-5">
        <div class="section-header">
            <h4 class="section-title">Autorisation :</h4>
        </div>
        
        <div class="row">
            @php
                $autorisationActivite = $activites->where('type', 'autorisation')->first();
                $documentTypes = [
                    'demande_autorisation' => ['name' => 'Demande d\'Autorisation', 'icon' => 'file-text', 'status' => 'Demande soumise'],
                    'pieces_jointes' => ['name' => 'Pièces Jointes', 'icon' => 'camera', 'status' => 'Documents joints'],
                    'suivi_dossier' => ['name' => 'Suivi Dossier', 'icon' => 'calendar', 'status' => 'En cours de traitement'],
                    'autorisation_finale' => ['name' => 'Autorisation Finale', 'icon' => 'bar-chart', 'status' => 'Autorisation obtenue']
                ];
            @endphp
            
            @foreach($documentTypes as $type => $config)
                @php
                    $documents = $autorisationActivite ? $autorisationActivite->documents->where('type', $type) : collect();
                    $hasDocuments = $documents->count() > 0;
                @endphp
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="document-card {{ $hasDocuments ? 'has-documents' : 'no-documents' }}" 
                         onclick="openDocumentModal('autorisation', '{{ $type }}', '{{ $config['name'] }}')">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="document-icon mb-3">
                                    @if($config['icon'] == 'file-text')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#file-text') }}"></use>
                                        </svg>
                                    @elseif($config['icon'] == 'camera')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#camera') }}"></use>
                                        </svg>
                                    @elseif($config['icon'] == 'calendar')
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#calendar') }}"></use>
                                        </svg>
                                    @else
                                        <svg width="60" height="60" fill="#6c757d">
                                            <use xlink:href="{{ asset('template_assets/img/icons/sprite.svg#bar-chart') }}"></use>
                                        </svg>
                                    @endif
                                </div>
                                
                                <h6 class="document-title mb-2">{{ $config['name'] }}</h6>
                                
                                <div class="document-status">
                                    @if($hasDocuments)
                                        <span class="badge bg-success mb-2">{{ $documents->count() }} document(s)</span>
                                    @else
                                        <span class="badge bg-secondary mb-2">Aucun document</span>
                                    @endif
                                </div>
                                
                                <p class="document-status-text text-primary small">{{ $config['status'] }}</p>
                                
                                @if($hasDocuments)
                                    <div class="document-actions mt-3">
                                        <button class="btn btn-sm btn-outline-primary me-1" title="Voir les documents">
                                            <img src="{{ asset('template_assets/img/icons/eye.svg') }}" alt="Voir" width="16">
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Ajouter un document">
                                            <img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="Ajouter" width="16">
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal pour afficher les documents -->
    <div class="modal fade" id="documentsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Documents</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Le contenu sera chargé dynamiquement -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="openUploadModal()">
                        <img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">
                        Ajouter Document
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'upload -->
    <div class="modal fade" id="uploadModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="uploadForm" action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="projet_id" value="{{ $projet->id }}">
                        <input type="hidden" name="activite_id" id="modal_activite_id">
                        <input type="hidden" name="type" id="modal_document_type">
                        
                        <div class="mb-3">
                            <label class="form-label">Fichier</label>
                            <input type="file" name="fichier" class="form-control" required accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.dwg,.3dm">
                            <small class="text-muted">Formats acceptés: PDF, DOC, XLS, Images, DWG, 3DM</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Description (optionnelle)</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Télécharger</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .project-title {
            color: #2c3e50;
            font-weight: 600;
        }

        .project-meta .meta-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 5px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .meta-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .meta-value {
            font-weight: 500;
        }

        .project-budget {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 10px;
        }

        .budget-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .budget-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .budget-amount {
            font-weight: 600;
            color: #495057;
        }

        .client-info {
            padding: 15px 0;
        }

        .client-name {
            font-size: 1.1rem;
            margin-bottom: 15px;
        }

        .client-details p {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .activity-section {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .section-header {
            margin-bottom: 30px;
            border-bottom: 3px solid #e9ecef;
            padding-bottom: 15px;
        }

        .section-title {
            color: #2c3e50;
            font-weight: 600;
            margin: 0;
        }

        .document-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .document-card:hover {
            transform: translateY(-5px);
        }

        .document-card .card {
            border: 2px solid transparent;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .document-card:hover .card {
            border-color: #007bff;
            background: #fff;
        }

        .document-card.has-documents .card {
            background: #fff;
            border-color: #28a745;
        }

        .document-card.has-documents:hover .card {
            border-color: #20c997;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.2);
        }

        .document-icon {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .document-title {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1rem;
        }

        .document-status {
            margin: 15px 0;
        }

        .document-status-text {
            font-weight: 500;
            margin: 0;
            line-height: 1.3;
        }

        .document-actions {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .document-card:hover .document-actions {
            opacity: 1;
        }

        .badge {
            font-size: 0.8rem;
            padding: 6px 12px;
        }

        .progress {
            height: 8px;
            border-radius: 10px;
            background-color: #e9ecef;
        }

        .progress-bar {
            border-radius: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .activity-section {
                padding: 20px 15px;
            }
            
            .document-card .card-body {
                padding: 20px 15px;
            }
            
            .document-title {
                font-size: 0.9rem;
            }
            
            .document-actions .btn {
                padding: 4px 8px;
            }
        }

        /* Animation pour l'apparition des cartes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .document-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .document-card:nth-child(1) { animation-delay: 0.1s; }
        .document-card:nth-child(2) { animation-delay: 0.2s; }
        .document-card:nth-child(3) { animation-delay: 0.3s; }
        .document-card:nth-child(4) { animation-delay: 0.4s; }
    </style>

    <script>
        let currentActivityType = '';
        let currentDocumentType = '';
        let currentActivityId = null;

        function openDocumentModal(activityType, documentType, documentName) {
            currentActivityType = activityType;
            currentDocumentType = documentType;
            
            // Trouver l'ID de l'activité correspondante
            @foreach($activites as $activite)
                if (activityType === '{{ $activite->type }}') {
                    currentActivityId = {{ $activite->id }};
                }
            @endforeach
            
            // Définir le titre du modal
            document.getElementById('modalTitle').textContent = documentName + ' - ' + activityType.charAt(0).toUpperCase() + activityType.slice(1);
            
            // Charger les documents via AJAX
            loadDocuments(activityType, documentType);
            
            // Afficher le modal
            new bootstrap.Modal(document.getElementById('documentsModal')).show();
        }

        function loadDocuments(activityType, documentType) {
            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div></div>';
            
            // Simuler le chargement des documents (remplacer par un appel AJAX réel)
            setTimeout(() => {
                let documentsHtml = '';
                
                @foreach($activites as $activite)
                    if (activityType === '{{ $activite->type }}') {
                        @foreach($activite->documents as $document)
                            if ('{{ $document->type }}' === documentType) {
                                documentsHtml += `
                                    <div class="document-item mb-3 p-3 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <div class="d-flex align-items-center">
                                                    <div class="file-icon me-3">
                                                        ${getFileIconHtml('{{ pathinfo($document->chemin_acces, PATHINFO_EXTENSION) }}')}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">{{ basename($document->chemin_acces) }}</h6>
                                                        <small class="text-muted">
                                                            Téléchargé le {{ $document->date_upload->format('d/m/Y à H:i') }}
                                                            @if($document->telecharge_par)
                                                                par {{ $document->telecharge_par }}
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('documents.view', $document) }}" class="btn btn-sm btn-outline-primary" target="_blank" title="Voir">
                                                        <img src="{{ asset('template_assets/img/icons/eye.svg') }}" alt="Voir" width="16">
                                                    </a>
                                                    <a href="{{ route('documents.download', $document) }}" class="btn btn-sm btn-outline-success" title="Télécharger">
                                                        <img src="{{ asset('template_assets/img/icons/download.svg') }}" alt="Télécharger" width="16">
                                                    </a>
                                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteDocument({{ $document->id }})" title="Supprimer">
                                                        <img src="{{ asset('template_assets/img/icons/delete.svg') }}" alt="Supprimer" width="16">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }
                        @endforeach
                    }
                @endforeach
                
                if (documentsHtml === '') {
                    documentsHtml = `
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <img src="{{ asset('template_assets/img/icons/folder.svg') }}" alt="Empty" width="64" height="64" class="opacity-50">
                            </div>
                            <h6 class="text-muted">Aucun document trouvé</h6>
                            <p class="text-muted">Commencez par ajouter des documents pour cette catégorie</p>
                        </div>
                    `;
                }
                
                modalBody.innerHTML = documentsHtml;
            }, 500);
        }

        function getFileIconHtml(extension) {
            const icons = {
                'pdf': '<div class="file-icon-small bg-danger text-white"><i class="fas fa-file-pdf"></i></div>',
                'doc': '<div class="file-icon-small bg-primary text-white"><i class="fas fa-file-word"></i></div>',
                'docx': '<div class="file-icon-small bg-primary text-white"><i class="fas fa-file-word"></i></div>',
                'xls': '<div class="file-icon-small bg-success text-white"><i class="fas fa-file-excel"></i></div>',
                'xlsx': '<div class="file-icon-small bg-success text-white"><i class="fas fa-file-excel"></i></div>',
                'jpg': '<div class="file-icon-small bg-warning text-white"><i class="fas fa-file-image"></i></div>',
                'jpeg': '<div class="file-icon-small bg-warning text-white"><i class="fas fa-file-image"></i></div>',
                'png': '<div class="file-icon-small bg-warning text-white"><i class="fas fa-file-image"></i></div>',
                'dwg': '<div class="file-icon-small bg-info text-white"><i class="fas fa-drafting-compass"></i></div>',
                '3dm': '<div class="file-icon-small bg-secondary text-white"><i class="fas fa-cube"></i></div>',
            };
            
            return icons[extension.toLowerCase()] || '<div class="file-icon-small bg-secondary text-white"><i class="fas fa-file"></i></div>';
        }

        function openUploadModal() {
            if (!currentActivityId) {
                alert('Aucune activité trouvée pour cette section. Veuillez d\'abord créer l\'activité.');
                return;
            }
            
            document.getElementById('modal_activite_id').value = currentActivityId;
            document.getElementById('modal_document_type').value = currentDocumentType;
            
            // Fermer le modal des documents et ouvrir celui d'upload
            bootstrap.Modal.getInstance(document.getElementById('documentsModal')).hide();
            new bootstrap.Modal(document.getElementById('uploadModal')).show();
        }

        function deleteDocument(documentId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) {
                // Créer un formulaire dynamique pour la suppression
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/documents/${documentId}`;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Animation au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des cartes de documents
            const documentCards = document.querySelectorAll('.document-card');
            documentCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            // Animation de la barre de progression du budget
            const progressBar = document.querySelector('.progress-bar');
            if (progressBar) {
                const finalWidth = progressBar.style.width;
                progressBar.style.width = '0%';
                
                setTimeout(() => {
                    progressBar.style.transition = 'width 2s ease-in-out';
                    progressBar.style.width = finalWidth;
                }, 500);
            }
        });

        // Gestion des événements de soumission du formulaire d'upload
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Téléchargement...';
            
            // Le formulaire se soumettra normalement
            // En cas d'erreur, vous pouvez réactiver le bouton
            setTimeout(() => {
                if (submitButton.disabled) {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                }
            }, 10000);
        });

        // Gestion du glisser-déposer pour l'upload de fichiers
        const fileInput = document.querySelector('input[type="file"]');
        const uploadModal = document.getElementById('uploadModal');
        
        uploadModal.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });
        
        uploadModal.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
        });
        
        uploadModal.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                // Afficher le nom du fichier
                const fileName = files[0].name;
                const fileLabel = document.querySelector('.form-label');
                fileLabel.textContent = `Fichier sélectionné: ${fileName}`;
            }
        });
    </script>

    <style>
        .file-icon-small {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
        
        .document-item {
            transition: all 0.3s ease;
        }
        
        .document-item:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
        }
        
        .drag-over {
            background-color: #f0f8ff;
            border: 2px dashed #007bff;
        }
        
        .btn-group .btn {
            margin: 0 2px;
        }
        
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
    </style>
@endsection