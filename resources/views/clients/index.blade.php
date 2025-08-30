@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Clients</h4>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item active">Liste des Clients</li>
            </ul>
        </div>
        <div class="page-btn">
            <a href="{{ route('clients.create') }}" class="btn btn-added"><img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">Ajouter un Client</a>
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
            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>Nom / Société</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                            <tr>
                                <td>{{ $client->societe ?? $client->prenom . ' ' . $client->nom }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->telephone }}</td>
                                <td>{{ ucfirst($client->type_client) }}</td>
                                <td>
                                    <a class="me-3" href="{{ route('clients.edit', $client) }}">
                                        <img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline delete-form">
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
                                <td colspan="5" class="text-center">Aucun client trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
