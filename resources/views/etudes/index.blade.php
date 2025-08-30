@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Études</h4>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item"><a href="{{ route('activites.index') }}">Activités</a></li>
                <li class="breadcrumb-item active">Liste des Études</li>
            </ul>
        </div>
        <div class="page-btn">
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'architecte')
                @if($responsables->isEmpty())
                    <div class="d-flex flex-column align-items-end">
                        <button type="button" class="btn btn-added" disabled>
                            <img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">
                            Nouvelle Étude
                        </button>
                        <small class="text-danger mt-1">Aucun architecte disponible pour assignation.</small>
                    </div>
                @else
                    <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createActivityModal" data-activity-type="etude">
                        <img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">
                        Nouvelle Étude
                    </button>
                @endif
            @endif
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
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <label class="me-2">Filtrer par statut:</label>
                        <select id="statusFilter" class="form-select" style="width: auto;">
                            <option value="all">Tous</option>
                            <option value="planifie">Planifié</option>
                            <option value="en_cours">En cours</option>
                            <option value="termine">Terminé</option>
                            <option value="retard">En retard</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <span class="me-2 text-muted">Total: {{ $etudes->count() }} études</span>
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
                                        <h5 class="fs-16 mb-0">Liste des Études</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="folderlist-data">
                            @forelse ($etudes as $etude)
                                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-12 folder-card" data-status="{{ $etude->statut }}">
                                    <div class="card project-card shadow-sm border-0 h-100" id="folder-{{ $etude->id }}">
                                        <div class="card-body position-relative">
                                            @php
                                                $statusConfig = [
                                                    'planifie' => ['text' => 'Planifié', 'color' => 'info', 'bg' => 'info'],
                                                    'en_cours' => ['text' => 'En cours', 'color' => 'primary', 'bg' => 'primary'],
                                                    'termine' => ['text' => 'Terminé', 'color' => 'success', 'bg' => 'success'],
                                                    'retard' => ['text' => 'En retard', 'color' => 'danger', 'bg' => 'danger']
                                                ];
                                                $config = $statusConfig[$etude->statut] ?? ['text' => 'Inconnu', 'color' => 'secondary', 'bg' => 'secondary'];
                                            @endphp
                                            
                                            <div class="position-absolute top-0 start-50 translate-middle">
                                                <span class="badge bg-{{ $config['bg'] }} text-white px-3 py-2 rounded-pill">
                                                    {{ $config['text'] }}
                                                </span>
                                            </div>
                                            
                                            <div class="text-center mt-4 mb-3">
                                                <div class="folder-icon-wrapper">
                                                    <svg width="80" height="64" viewBox="0 0 80 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8 8C8 5.79086 9.79086 4 12 4H32L40 12H68C70.2091 12 72 13.7909 72 16V52C72 54.2091 70.2091 56 68 56H12C9.79086 56 8 54.2091 8 52V8Z" fill="#2196F3" stroke="#1976D2" stroke-width="2"/>
                                                        <path d="M8 16H72V52C72 54.2091 70.2091 56 68 56H12C9.79086 56 8 54.2091 8 52V16Z" fill="#64B5F6"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <div class="text-center">
                                                <h6 class="project-title mb-2">Étude N°{{ $etude->id }}</h6>
                                                <p class="project-subtitle text-muted mb-3">{{ Str::limit($etude->description, 35) }}</p>
                                            </div>
                                            
                                            <div class="project-details">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">Projet:</small>
                                                    <small class="fw-bold">
                                                        <a href="{{ route('projets.show', $etude->projet) }}" class="text-dark">{{ Str::limit($etude->projet->titre, 15) }}</a>
                                                    </small>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <small class="text-muted">Responsable:</small>
                                                    <small class="fw-bold">{{ $etude->responsable->prenom }}</small>
                                                </div>
                                            </div>
                                            
                                            <div class="project-actions d-flex justify-content-center gap-2">
                                                <a href="{{ route('activites.show', $etude) }}" class="btn btn-outline-info btn-sm" title="Voir les détails">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('activites.edit', $etude) }}" class="btn btn-outline-warning btn-sm" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('activites.destroy', $etude) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
                                        <h5 class="text-muted">Aucune étude trouvée</h5>
                                        <p class="text-muted">Commencez par créer une nouvelle activité de type "étude"</p>
                                        <a href="{{ route('activites.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Créer une activité
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        
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
            filter: drop-shadow(0 4px 8px rgba(33, 150, 243, 0.3));
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
        
        .folder-card {
            transition: all 0.3s ease;
        }
        
        .folder-card.hide {
            display: none;
        }
    </style>

    <script>
        document.getElementById('statusFilter').addEventListener('change', function() {
            const selectedStatus = this.value;
            const cards = document.querySelectorAll('.folder-card');
            
            cards.forEach(card => {
                if (selectedStatus === 'all' || card.dataset.status === selectedStatus) {
                    card.classList.remove('hide');
                } else {
                    card.classList.add('hide');
                }
            });
        });
        
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/5.3.6/simplebar.min.js"></script>
    <script>
        document.querySelectorAll('[data-simplebar]').forEach(el => {
            new SimpleBar(el);
        });
    </script>
@endpush

@include('activites._modal_create')

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createActivityModal = document.getElementById('createActivityModal');
        const createActivityForm = document.getElementById('createActivityForm');
        const modal = new bootstrap.Modal(createActivityModal);

        // Personnaliser et pré-remplir la modale à l'ouverture
        createActivityModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const activityType = button.getAttribute('data-activity-type');
            
            const typeInput = createActivityModal.querySelector('#activityType');
            const titleSpan = createActivityModal.querySelector('#createActivityModalLabel'); // Corrected ID
            
            typeInput.value = activityType;
            titleSpan.textContent = activityType.charAt(0).toUpperCase() + activityType.slice(1);
        });

        // Gérer la soumission du formulaire en AJAX
        createActivityForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const action = this.getAttribute('action');

            // Nettoyer les erreurs précédentes
            document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            fetch(action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': formData.get('_token')
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    modal.hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès !',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'gemini-swal-popup'
                        }
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(response => {
                // Try to parse the response as JSON for validation errors first
                response.json().then(errorData => {
                    if (errorData.errors) {
                        // Afficher les nouvelles erreurs de validation
                        for (const field in errorData.errors) {
                            const input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                let errorContainer = input.closest('.form-group').querySelector('.invalid-feedback');
                                if (!errorContainer) {
                                    errorContainer = document.createElement('div');
                                    errorContainer.className = 'invalid-feedback';
                                    input.parentNode.appendChild(errorContainer);
                                }
                                errorContainer.textContent = errorData.errors[field][0];
                            }
                        }
                    } else {
                         // If it's JSON but not a validation error, show generic error
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur !',
                            text: 'Une erreur inattendue est survenue.',
                        });
                    }
                }).catch(() => {
                    // If parsing as JSON fails, it's likely HTML. Log it as text.
                    response.text().then(text => {
                        console.error('Server returned non-JSON response:', text);
                        Swal.fire({
                            icon: 'error',
                            title: 'Erreur Serveur',
                            text: 'Le serveur a retourné une réponse inattendue. Vérifiez la console du navigateur pour les détails.',
                        });
                    });
                });
            });
        });

        // Si le formulaire a des erreurs de validation (fallback non-AJAX), rouvrir la modale
        @if($errors->any())
            modal.show();
        @endif
    });
</script>
@endpush

