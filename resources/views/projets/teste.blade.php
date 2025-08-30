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
            <a href="{{ route('projets.create') }}" class="btn btn-added"><img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">Nouveau Projet</a>
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
                        <div class="row" id="folderlist-data">
                            @forelse ($projets as $projet)
                                <div class="col-xxl-3 col-6 folder-card etat-{{ $projet->etat }}">
                                    <a href="{{ route('projets.show', $projet) }}" class="text-decoration-none">
                                        <div class="card bg-light shadow-none" id="folder-{{ $projet->id }}">
                                            <div class="card-body">
                                                @php
                                                    $statusText = '';
                                                    $statusColor = '';
                                                    switch ($projet->etat) {
                                                        case 'en_attente':
                                                            $statusText = 'En attente';
                                                            $statusColor = 'text-warning';
                                                            break;
                                                        case 'en_cours':
                                                            $statusText = 'En cours';
                                                            $statusColor = 'text-primary';
                                                            break;
                                                        case 'termine':
                                                            $statusText = 'Terminé';
                                                            $statusColor = 'text-success';
                                                            break;
                                                        case 'suspendu':
                                                            $statusText = 'Suspendu';
                                                            $statusColor = 'text-danger';
                                                            break;
                                                        case 'planifie':
                                                            $statusText = 'Planifié';
                                                            $statusColor = 'text-info';
                                                            break;
                                                        default:
                                                            $statusText = 'Inconnu';
                                                            $statusColor = 'text-secondary';
                                                    }
                                                @endphp
                                                <p style="text-align:center;" class="{{ $statusColor }}">
                                                    <b>{{ $statusText }}</b>
                                                </p>
                                                <div class="text-center">
                                                    <div class="mb-2">
                                                        <i class="ion-folder align-bottom text-warning display-5"></i>
                                                    </div>
                                                    <h6 class="fs-15 folder-name">Projet N°{{ $projet->id }} - {{ $projet->titre }}</h6>
                                                </div>
                                                <div class="hstack mt-4 text-muted">
                                                    <span class="me-auto"><b>Client: {{ $projet->client->societe ?? $projet->client->prenom . ' ' . $projet->client->nom }}</b></span>
                                                    <span><b>{{ $projet->created_at->format('d/m/Y') }}</b></span>
                                                </div>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <a class="me-3" href="{{ route('projets.edit', $projet) }}">
                                                        <img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="Edit">
                                                    </a>
                                                    <form action="{{ route('projets.destroy', $projet) }}" method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link p-0 m-0">
                                                            <img src="{{ asset('template_assets/img/icons/delete.svg') }}" alt="Delete">
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <p>Aucun projet trouvé.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
