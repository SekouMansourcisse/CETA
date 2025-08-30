@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Projets</h4>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item active">Liste des Projets</li>
            </ul>
        </div>
        <div class="page-btn">
            @can('projets.create')
            <a href="{{ route('projets.create') }}" class="btn btn-added">
                <img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">
                Créer un projet
            </a>
            @endcan
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succès !</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filtres Avancés et Recherche -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-filter me-2"></i>Filtres Avancés et Recherche
            </h5>
        </div>
        <div class="card-body">
            <!-- Barre de recherche principale -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="search-wrapper position-relative">
                        <i class="fas fa-search position-absolute start-0 top-50 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" id="globalSearch" class="form-control form-control-lg ps-5" 
                               placeholder="🔍 Rechercher un projet par titre, client, description, numéro...">
                        <div class="search-suggestions position-absolute w-100 bg-white border rounded shadow-sm d-none" 
                             style="top: 100%; z-index: 1000; max-height: 300px; overflow-y: auto;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres principaux -->
            <form action="{{ route('projets.index') }}" method="GET" id="filterForm">
                <div class="row g-3 mb-3">
                    <!-- Filtre par année -->
                    <div class="col-md-3">
                        <label for="yearFilter" class="form-label fw-bold">
                            <i class="fas fa-calendar me-1"></i>Année
                        </label>
                        <select name="year" id="yearFilter" class="form-select">
                            <option value="">Toutes les années</option>
                            @for($year = date('Y'); $year >= 2020; $year--)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Filtre par statut -->
                    <div class="col-md-3">
                        <label for="statusFilter" class="form-label fw-bold">
                            <i class="fas fa-tasks me-1"></i>Statut
                        </label>
                        <select name="status" id="statusFilter" class="form-select">
                            <option value="">Tous les statuts</option>
                            <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>
                                En attente
                            </option>
                            <option value="en_cours" {{ request('status') == 'en_cours' ? 'selected' : '' }}>
                                En cours
                            </option>
                            <option value="termine" {{ request('status') == 'termine' ? 'selected' : '' }}>
                                Terminé
                            </option>
                            <option value="suspendu" {{ request('status') == 'suspendu' ? 'selected' : '' }}>
                                Suspendu
                            </option>
                            <option value="planifie" {{ request('status') == 'planifie' ? 'selected' : '' }}>
                                Planifié
                            </option>
                        </select>
                    </div>

                    <!-- Filtre par client -->
                    <div class="col-md-3">
                        <label for="clientFilter" class="form-label fw-bold">
                            <i class="fas fa-user me-1"></i>Client
                        </label>
                        <select name="client_id" id="clientFilter" class="form-select">
                            <option value="">Tous les clients</option>
                            @foreach($clients ?? [] as $client)
                                <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->societe ?? $client->prenom . ' ' . $client->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtre par responsable -->
                    <div class="col-md-3">
                        <label for="responsableFilter" class="form-label fw-bold">
                            <i class="fas fa-user-tie me-1"></i>Responsable
                        </label>
                        <select name="responsable_id" id="responsableFilter" class="form-select">
                            <option value="">Tous les responsables</option>
                            @foreach($responsables ?? [] as $responsable)
                                <option value="{{ $responsable->id }}" {{ request('responsable_id') == $responsable->id ? 'selected' : '' }}>
                                    {{ $responsable->prenom . ' ' . $responsable->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Filtres avancés (dépliables) -->
                <div class="row mb-3">
                    <div class="col-12">
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="toggleAdvancedFilters">
                            <i class="fas fa-cog me-1"></i>Filtres Avancés
                            <i class="fas fa-chevron-down ms-1"></i>
                        </button>
                    </div>
                </div>

                <div class="row g-3 mb-3" id="advancedFilters" style="display: none;">
                    <!-- Filtre par budget -->
                    <div class="col-md-3">
                        <label for="budgetMin" class="form-label fw-bold">
                            <i class="fas fa-euro-sign me-1"></i>Budget Min
                        </label>
                        <input type="number" name="budget_min" id="budgetMin" class="form-control" 
                               placeholder="0" value="{{ request('budget_min') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="budgetMax" class="form-label fw-bold">
                            <i class="fas fa-euro-sign me-1"></i>Budget Max
                        </label>
                        <input type="number" name="budget_max" id="budgetMax" class="form-control" 
                               placeholder="∞" value="{{ request('budget_max') }}">
                    </div>

                    <!-- Filtre par date -->
                    <div class="col-md-3">
                        <label for="dateDebut" class="form-label fw-bold">
                            <i class="fas fa-calendar-plus me-1"></i>Date Début
                        </label>
                        <input type="date" name="date_debut" id="dateDebut" class="form-control" 
                               value="{{ request('date_debut') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="dateFin" class="form-label fw-bold">
                            <i class="fas fa-calendar-minus me-1"></i>Date Fin
                        </label>
                        <input type="date" name="date_fin" id="dateFin" class="form-control" 
                               value="{{ request('date_fin') }}">
                    </div>

                    <!-- Filtre par priorité -->
                    <div class="col-md-3">
                        <label for="prioriteFilter" class="form-label fw-bold">
                            <i class="fas fa-exclamation-triangle me-1"></i>Priorité
                        </label>
                        <select name="priorite" id="prioriteFilter" class="form-select">
                            <option value="">Toutes les priorités</option>
                            <option value="basse" {{ request('priorite') == 'basse' ? 'selected' : '' }}>Basse</option>
                            <option value="normale" {{ request('priorite') == 'normale' ? 'selected' : '' }}>Normale</option>
                            <option value="haute" {{ request('priorite') == 'haute' ? 'selected' : '' }}>Haute</option>
                            <option value="urgente" {{ request('priorite') == 'urgente' ? 'selected' : '' }}>Urgente</option>
                        </select>
                    </div>

                    <!-- Filtre par type de projet -->
                    <div class="col-md-3">
                        <label for="typeFilter" class="form-label fw-bold">
                            <i class="fas fa-tag me-1"></i>Type de Projet
                        </label>
                        <select name="type" id="typeFilter" class="form-select">
                            <option value="">Tous les types</option>
                            <option value="residentiel" {{ request('type') == 'residentiel' ? 'selected' : '' }}>Résidentiel</option>
                            <option value="commercial" {{ request('type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
                            <option value="industriel" {{ request('type') == 'industriel' ? 'selected' : '' }}>Industriel</option>
                            <option value="infrastructure" {{ request('type') == 'infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                        </select>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i>Appliquer les Filtres
                        </button>
                        <a href="{{ route('projets.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-undo me-1"></i>Réinitialiser
                        </a>
                        <button type="button" class="btn btn-outline-info btn-sm" id="saveFilters">
                            <i class="fas fa-save me-1"></i>Sauvegarder
                        </button>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <span class="me-3 text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                <span id="resultCount">{{ $projets->count() }}</span> projets trouvés
                            </span>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm active" id="gridView" title="Vue Grille">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="listView" title="Vue Liste">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tags de filtres actifs -->
    @if(request()->hasAny(['year', 'status', 'client_id', 'responsable_id', 'budget_min', 'budget_max', 'date_debut', 'date_fin', 'priorite', 'type']))
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex align-items-center flex-wrap gap-2">
                <span class="text-muted me-2">Filtres actifs :</span>
                @foreach(request()->all() as $key => $value)
                    @if($value && !in_array($key, ['_token', 'page']))
                        <span class="badge bg-primary d-flex align-items-center">
                            {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $value }}
                            <a href="{{ request()->except([$key, 'page']) }}" class="text-white ms-2 text-decoration-none">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Liste des Projets -->
    <div class="card">
        <div class="card-body">
            <div class="file-manager-content w-100 p-3 py-0">
                <div class="mx-n3 pt-4 px-4 file-manager-content-scroll" data-simplebar>
                    <div id="folder-list" class="mb-2">
                        <div class="row justify-content-between g-2 mb-3">
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="fs-16 mb-0">Liste des Projets</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Vue en grille -->
                        <div class="row" id="folderlist-data">
                            @forelse ($projets as $projet)
                                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-12 folder-card etat-{{ $projet->etat }}" 
                                     data-status="{{ $projet->etat }}"
                                     data-client="{{ strtolower($projet->client->societe ?? $projet->client->prenom . ' ' . $projet->client->nom) }}"
                                     data-responsable="{{ strtolower($projet->responsable->prenom . ' ' . $projet->responsable->nom) }}"
                                     data-year="{{ $projet->created_at->format('Y') }}"
                                     data-budget="{{ $projet->budget_prevu ?? 0 }}">
                                    <div class="card project-card shadow-sm border-0 h-100" id="folder-{{ $projet->id }}">
                                        <div class="card-body position-relative">
                                            @php
                                                $statusConfig = [
                                                    'en_attente' => ['text' => 'En attente de Validation résultat', 'color' => 'warning', 'bg' => 'warning'],
                                                    'en_cours' => ['text' => 'En cours', 'color' => 'primary', 'bg' => 'primary'],
                                                    'termine' => ['text' => 'Demande traité', 'color' => 'success', 'bg' => 'success'],
                                                    'suspendu' => ['text' => 'Suspendu', 'color' => 'danger', 'bg' => 'danger'],
                                                    'planifie' => ['text' => 'Planifié', 'color' => 'info', 'bg' => 'info']
                                                ];
                                                $config = $statusConfig[$projet->etat] ?? ['text' => 'Inconnu', 'color' => 'secondary', 'bg' => 'secondary'];
                                            @endphp
                                            
                                            <!-- Badge de statut -->
                                            <div class="position-absolute top-0 start-50 translate-middle">
                                                <span class="badge bg-{{ $config['bg'] }} text-white px-3 py-2 rounded-pill">
                                                    {{ $config['text'] }}
                                                </span>
                                            </div>
                                            
                                            <!-- Icône de dossier -->
                                            <div class="text-center mt-4 mb-3">
                                                <div class="folder-icon-wrapper">
                                                    <svg width="80" height="64" viewBox="0 0 80 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 8C8 5.79086 9.79086 4 12 4H32L40 12H68C70.2091 12 72 13.7909 72 16V52C72 54.2091 70.2091 56 68 56H12C9.79086 56 8 54.2091 8 52V8Z" fill="#FFA500" stroke="#FF8C00" stroke-width="2"/>
                                                        <path d="M8 16H72V52C72 54.2091 70.2091 56 68 56H12C9.79086 56 8 54.2091 8 52V16Z" fill="#FFB84D"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <!-- Informations du projet -->
                                            <div class="text-center">
                                                <h6 class="project-title mb-2">Projet N°{{ $projet->id }}</h6>
                                                <p class="project-subtitle text-muted mb-3">{{ Str::limit($projet->titre, 30) }}</p>
                                            </div>
                                            
                                            <!-- Détails du projet -->
                                            <div class="project-details">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">Client:</small>
                                                    <small class="fw-bold">
                                                        {{ Str::limit($projet->client->societe ?? $projet->client->prenom . ' ' . $projet->client->nom, 15) }}
                                                    </small>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">Responsable:</small>
                                                    <small class="fw-bold">
                                                        {{ Str::limit($projet->responsable->prenom . ' ' . $projet->responsable->nom, 15) }}
                                                    </small>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">Budget:</small>
                                                    <small class="fw-bold text-primary">
                                                        {{ number_format($projet->budget_prevu ?? 0, 0, ',', ' ') }} €
                                                    </small>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <small class="text-muted">Date:</small>
                                                    <small class="fw-bold">{{ $projet->created_at->format('d/m/Y') }}</small>
                                                </div>
                                            </div>
                                            
                                            <!-- Actions -->
                                            <div class="project-actions d-flex justify-content-center gap-2">
                                                <a href="{{ route('projets.show', $projet) }}" class="btn btn-outline-primary btn-sm" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @can('projets.edit')
                                                <a href="{{ route('projets.edit', $projet) }}" class="btn btn-outline-warning btn-sm" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('projets.delete')
                                                <form action="{{ route('projets.destroy', $projet) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <div class="mb-3">
                                            <svg width="100" height="80" viewBox="0 0 100 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 10C10 7.79086 11.7909 6 14 6H40L50 16H86C88.2091 16 90 17.7909 90 20V66C90 68.2091 88.2091 70 86 70H14C11.7909 70 10 68.2091 10 66V10Z" fill="#E5E5E5" stroke="#CCCCCC" stroke-width="2"/>
                                            </svg>
                                        </div>
                                        <h5 class="text-muted">Aucun projet trouvé</h5>
                                        <p class="text-muted">Commencez par créer votre premier projet</p>
                                        <a href="{{ route('projets.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Créer un projet
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Pagination si nécessaire -->
                        @if(method_exists($projets, 'links'))
                            <div class="d-flex justify-content-center mt-4">
                                {{ $projets->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .project-card {
            transition: all 0.3s ease;
            border-radius: 12px;
        }
        
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
        
        .folder-icon-wrapper {
            filter: drop-shadow(0 4px 8px rgba(255, 165, 0, 0.3));
        }
        
        .project-title {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .project-subtitle {
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .project-details {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .project-actions .btn {
            border-radius: 6px;
            padding: 6px 12px;
        }
        
        .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        /* Animations pour les filtres */
        .folder-card {
            transition: all 0.3s ease;
        }
        
        .folder-card.hide {
            opacity: 0;
            transform: scale(0.8);
            pointer-events: none;
        }
        
        /* Styles pour les filtres avancés */
        .search-wrapper {
            position: relative;
        }
        
        .search-suggestions {
            border: 1px solid #dee2e6;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .search-suggestion-item {
            padding: 8px 12px;
            cursor: pointer;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .search-suggestion-item:hover {
            background-color: #f8f9fa;
        }
        
        .search-suggestion-item:last-child {
            border-bottom: none;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .project-details {
                font-size: 0.85rem;
            }
            
            .project-actions .btn {
                padding: 4px 8px;
                font-size: 0.8rem;
            }
            
            .card-header h5 {
                font-size: 1rem;
            }
        }
    </style>

    <script>
        // Filtrage par statut
        document.getElementById('statusFilter').addEventListener('change', function() {
            const selectedStatus = this.value;
            const cards = document.querySelectorAll('.folder-card');
            
            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');
                
                if (selectedStatus === '' || cardStatus === selectedStatus) {
                    card.classList.remove('hide');
                } else {
                    card.classList.add('hide');
                }
            });
            
            updateResultCount();
        });
        
        // Recherche globale en temps réel
        let searchTimeout;
        document.getElementById('globalSearch').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const searchTerm = this.value.toLowerCase();
            
            searchTimeout = setTimeout(() => {
                const cards = document.querySelectorAll('.folder-card');
                let visibleCount = 0;
                
                cards.forEach(card => {
                    const title = card.querySelector('.project-title').textContent.toLowerCase();
                    const subtitle = card.querySelector('.project-subtitle').textContent.toLowerCase();
                    const client = card.getAttribute('data-client');
                    const responsable = card.getAttribute('data-responsable');
                    const year = card.getAttribute('data-year');
                    
                    const isVisible = title.includes(searchTerm) || 
                                    subtitle.includes(searchTerm) || 
                                    client.includes(searchTerm) || 
                                    responsable.includes(searchTerm) || 
                                    year.includes(searchTerm);
                    
                    if (isVisible) {
                        card.classList.remove('hide');
                        visibleCount++;
                    } else {
                        card.classList.add('hide');
                    }
                });
                
                updateResultCount(visibleCount);
            }, 300);
        });
        
        // Filtres avancés
        document.getElementById('toggleAdvancedFilters').addEventListener('click', function() {
            const advancedFilters = document.getElementById('advancedFilters');
            const icon = this.querySelector('.fa-chevron-down');
            
            if (advancedFilters.style.display === 'none') {
                advancedFilters.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                advancedFilters.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
        
        // Filtrage en temps réel pour les autres filtres
        ['yearFilter', 'clientFilter', 'responsableFilter', 'budgetMin', 'budgetMax', 'dateDebut', 'dateFin', 'prioriteFilter', 'typeFilter'].forEach(filterId => {
            const element = document.getElementById(filterId);
            if (element) {
                element.addEventListener('change', applyFilters);
            }
        });
        
        // Application des filtres
        function applyFilters() {
            const year = document.getElementById('yearFilter').value;
            const status = document.getElementById('statusFilter').value;
            const client = document.getElementById('clientFilter').value;
            const responsable = document.getElementById('responsableFilter').value;
            const budgetMin = document.getElementById('budgetMin').value;
            const budgetMax = document.getElementById('budgetMax').value;
            const dateDebut = document.getElementById('dateDebut').value;
            const dateFin = document.getElementById('dateFin').value;
            const priorite = document.getElementById('prioriteFilter').value;
            const type = document.getElementById('typeFilter').value;
            
            const cards = document.querySelectorAll('.folder-card');
            let visibleCount = 0;
            
            cards.forEach(card => {
                let isVisible = true;
                
                // Filtre par année
                if (year && card.getAttribute('data-year') !== year) {
                    isVisible = false;
                }
                
                // Filtre par statut
                if (status && card.getAttribute('data-status') !== status) {
                    isVisible = false;
                }
                
                // Filtre par budget
                const budget = parseInt(card.getAttribute('data-budget'));
                if (budgetMin && budget < parseInt(budgetMin)) {
                    isVisible = false;
                }
                if (budgetMax && budget > parseInt(budgetMax)) {
                    isVisible = false;
                }
                
                if (isVisible) {
                    card.classList.remove('hide');
                    visibleCount++;
                } else {
                    card.classList.add('hide');
                }
            });
            
            updateResultCount(visibleCount);
        }
        
        // Mise à jour du compteur de résultats
        function updateResultCount(count = null) {
            const resultCount = document.getElementById('resultCount');
            if (count !== null) {
                resultCount.textContent = count;
            } else {
                const visibleCards = document.querySelectorAll('.folder-card:not(.hide)');
                resultCount.textContent = visibleCards.length;
            }
        }
        
        // Sauvegarde des filtres
        document.getElementById('saveFilters').addEventListener('click', function() {
            const filters = {
                year: document.getElementById('yearFilter').value,
                status: document.getElementById('statusFilter').value,
                client_id: document.getElementById('clientFilter').value,
                responsable_id: document.getElementById('responsableFilter').value,
                budget_min: document.getElementById('budgetMin').value,
                budget_max: document.getElementById('budgetMax').value,
                date_debut: document.getElementById('dateDebut').value,
                date_fin: document.getElementById('dateFin').value,
                priorite: document.getElementById('prioriteFilter').value,
                type: document.getElementById('typeFilter').value
            };
            
            localStorage.setItem('projets_filters', JSON.stringify(filters));
            
            // Notification de succès
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i>Sauvegardé !';
            btn.classList.remove('btn-outline-info');
            btn.classList.add('btn-success');
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-info');
            }, 2000);
        });
        
        // Chargement des filtres sauvegardés
        document.addEventListener('DOMContentLoaded', function() {
            const savedFilters = localStorage.getItem('projets_filters');
            if (savedFilters) {
                const filters = JSON.parse(savedFilters);
                
                Object.keys(filters).forEach(key => {
                    const element = document.getElementById(key.replace('_', '') + 'Filter');
                    if (element && filters[key]) {
                        element.value = filters[key];
                    }
                });
                
                // Appliquer les filtres sauvegardés
                applyFilters();
            }
            
            // Animation d'entrée des cartes
            const cards = document.querySelectorAll('.project-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
        
        // Vue grille/liste
        document.getElementById('gridView').addEventListener('click', function() {
            document.getElementById('folderlist-data').className = 'row';
            this.classList.add('active');
            document.getElementById('listView').classList.remove('active');
        });
        
        document.getElementById('listView').addEventListener('click', function() {
            document.getElementById('folderlist-data').className = 'row list-view';
            this.classList.add('active');
            document.getElementById('gridView').classList.remove('active');
        });
    </script>
@endsection