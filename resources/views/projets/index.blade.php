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

    <!-- Filtres et contrôles -->
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('projets.index') }}" method="GET" class="mb-3">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="yearFilter">Année :</label>
                            <input type="number" name="year" id="yearFilter" class="form-control" value="{{ request('year') }}" placeholder="Ex: 2023">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="clientNameFilter">Nom du client :</label>
                            <input type="text" name="client_name" id="clientNameFilter" class="form-control" value="{{ request('client_name') }}" placeholder="Nom du client">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filtrer</button>
                        <a href="{{ route('projets.index') }}" class="btn btn-secondary">Réinitialiser</a>
                    </div>
                </div>
            </form>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <label class="me-2">Filtrer par statut:</label>
                        <select id="statusFilter" class="form-select" style="width: auto;">
                            <option value="all">Tous</option>
                            <option value="en_attente">En attente</option>
                            <option value="en_cours">En cours</option>
                            <option value="termine">Terminé</option>
                            <option value="suspendu">Suspendu</option>
                            <option value="planifie">Planifié</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <span class="me-2 text-muted">Total: {{ $projets->count() }} projets</span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-sm active" id="gridView">
                                <i class="fas fa-th"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="listView">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-12 folder-card etat-{{ $projet->etat }}" data-status="{{ $projet->etat }}">
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
        
        /* Responsive */
        @media (max-width: 768px) {
            .project-details {
                font-size: 0.85rem;
            }
            
            .project-actions .btn {
                padding: 4px 8px;
                font-size: 0.8rem;
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
                
                if (selectedStatus === 'all' || cardStatus === selectedStatus) {
                    card.classList.remove('hide');
                } else {
                    card.classList.add('hide');
                }
            });
        });
        
        // Animation d'entrée des cartes
        document.addEventListener('DOMContentLoaded', function() {
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
    </script>
@endsection