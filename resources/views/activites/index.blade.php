@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Activités</h4>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item active">Liste des Activités</li>
            </ul>
        </div>
        <div class="page-btn">
            <a href="{{ route('activites.create') }}" class="btn btn-added"><img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">Nouvelle Activité</a>
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
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <form action="{{ route('activites.index') }}" method="GET" class="d-flex">
                            <select name="type" class="form-select me-2">
                                <option value="">Toutes les Activités</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Filtrer</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Projet</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Dates</th>
                            <th>Responsable</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activites as $activite)
                            <tr>
                                <td>{{ Str::limit($activite->description, 40) }}</td>
                                <td><a href="{{ route('projets.edit', $activite->projet) }}">{{ $activite->projet->titre }}</a></td>
                                <td>{{ ucfirst($activite->type) }}</td>
                                <td>{{ ucfirst($activite->statut) }}</td>
                                <td>{{ $activite->date_debut }} au {{ $activite->date_fin }}</td>
                                <td>{{ $activite->responsable->prenom }} {{ $activite->responsable->nom }}</td>
                                <td>
                                    <a class="me-3" href="{{ route('activites.edit', $activite) }}">
                                        <img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <form action="{{ route('activites.destroy', $activite) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0">
                                             <img src="{{ asset('template_assets/img/icons/delete.svg') }}" alt="img">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Aucune activité trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection