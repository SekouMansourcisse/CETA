@extends('layouts.template')

@section('content')

<div class="page-header">
    <div class="page-title">
        <h4>Paramètres</h4>
        <h6>Gérez les informations de votre compte et les utilisateurs.</h6>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succès !</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" href="#solid-rounded-tab1" data-bs-toggle="tab">Mon Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#solid-rounded-tab2" data-bs-toggle="tab">Gestion des utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#solid-rounded-tab3" data-bs-toggle="tab">Sécurité</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#solid-rounded-tab4" data-bs-toggle="tab">Historique</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="solid-rounded-tab1">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Informations Personnelles</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('settings.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Prénom</label>
                                                <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', auth()->user()->prenom) }}">
                                                @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Nom</label>
                                                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', auth()->user()->nom) }}">
                                                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Email (Login)</label>
                                                <input type="text" name="login" class="form-control" value="{{ auth()->user()->login }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Rôle</label>
                                                <input type="text" name="role" class="form-control" value="{{ auth()->user()->role }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-submit me-2">Sauvegarder</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="solid-rounded-tab2">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Utilisateurs du Cabinet</h5>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    <i class="fas fa-plus me-1"></i> Ajouter un utilisateur
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Rôle</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $u)
                                                <tr>
                                                    <td>{{ $u->prenom }} {{ $u->nom }}</td>
                                                    <td>{{ $u->role }}</td>
                                                    <td><span class="badge {{ $u->actif ? 'bg-success' : 'bg-danger' }}">{{ $u->actif ? 'Actif' : 'Inactif' }}</span></td>
                                                    <td>
                                                        <a class="me-3" href="{{ route('users.edit', $u) }}"><img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="img"></a>
                                                        <form action="{{ route('users.destroy', $u) }}" method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="_redirect_to" value="settings.index">
                                                            <button type="submit" class="btn btn-link p-0 m-0">
                                                                <img src="{{ asset('template_assets/img/icons/delete.svg') }}" alt="img">
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="solid-rounded-tab3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Mot de passe et Sécurité</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('settings.password.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Mot de passe actuel</label>
                                                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                                                @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Nouveau mot de passe</label>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Confirmer le nouveau mot de passe</label>
                                                <input type="password" name="password_confirmation" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-submit me-2">Changer le mot de passe</button>
                                            <button type="button" id="toggleAllPasswords" class="btn btn-secondary">Voir mot de passe</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="solid-rounded-tab4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Historique des Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Utilisateur</th>
                                                <th>Action</th>
                                                <th>Modèle</th>
                                                <th>ID Modèle</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($historiques as $historique)
                                                <tr>
                                                    <td>{{ $historique->user->prenom ?? 'N/A' }} {{ $historique->user->nom ?? '' }}</td>
                                                    <td>{{ ucfirst($historique->action) }}</td>
                                                    <td>{{ class_basename($historique->model_type) }}</td>
                                                    <td>{{ $historique->model_id ?? 'N/A' }}</td>
                                                    <td>{{ $historique->description ?? 'N/A' }}</td>
                                                    <td>{{ $historique->created_at->format('d/m/Y H:i:s') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Aucun historique trouvé.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{ $historiques->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Ajouter un nouvel utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="user_prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="user_prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="user_nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_email" class="form-label">Login</label>
                        <input type="text" class="form-control" id="login" name="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="user_password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="user_password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="user_role" class="form-label">Rôle</label>
                        <select class="form-select" id="user_role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">Utilisateur</option>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="user_actif" name="actif" value="1" checked>
                        <label class="form-check-label" for="user_actif">Actif</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle form submissions for profile and password updates
        // These forms are already handled by Laravel's default form submission
        // and will redirect back with success/error messages.

        // Display validation errors after form submission
        @if ($errors->any())
            const firstErrorTab = document.querySelector('.is-invalid').closest('.tab-pane');
            if (firstErrorTab) {
                const tabId = firstErrorTab.id;
                document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
                
                document.querySelector(`a[href="#${tabId}"]`).classList.add('active');
                document.getElementById(tabId).classList.add('show', 'active');
            }
        @endif

        // Show success message if present
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès !',
                text: '{{ session('success') }}',
            });
        @endif

        // Password toggle functionality
        const toggleAllPasswordsBtn = document.getElementById('toggleAllPasswords');
        if (toggleAllPasswordsBtn) {
            toggleAllPasswordsBtn.addEventListener('click', function() {
                const passwordInputs = document.querySelectorAll('#solid-rounded-tab3 input[type="password"], #solid-rounded-tab3 input[type="text"]');
                let allArePassword = true;

                passwordInputs.forEach(input => {
                    if (input.type === 'text') {
                        allArePassword = false;
                    }
                });

                passwordInputs.forEach(input => {
                    if (allArePassword) {
                        input.type = 'text';
                    } else {
                        input.type = 'password';
                    }
                });

                if (allArePassword) {
                    this.textContent = 'Cacher mot de passe';
                } else {
                    this.textContent = 'Voir mot de passe';
                }
            });
        }
    });
</script>
@endpush