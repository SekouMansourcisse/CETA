@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Paiements</h4>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item active">Liste des Paiements</li>
            </ul>
        </div>
        <div class="page-btn">
            @can('paiements.create')
            <a href="{{ route('paiements.create') }}" class="btn btn-added"><img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">Enregistrer un Paiement</a>
            @endcan
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
                            <th>Date</th>
                            <th>Client</th>
                            <th>Projet</th>
                            <th>Moyen de Paiement</th>
                            <th>Montant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($paiements as $paiement)
                            <tr>
                                <td>{{ $paiement->date }}</td>
                                <td>{{ $paiement->client->societe ?? $paiement->client->prenom . ' ' . $paiement->client->nom }}</td>
                                <td><a href="{{ route('projets.edit', $paiement->projet) }}">{{ $paiement->projet->titre }}</a></td>
                                <td>{{ ucfirst($paiement->moyen_paiement) }}</td>
                                <td>{{ number_format($paiement->montant, 2, ',', ' ') }} €</td>
                                <td>
                                    @can('paiements.edit')
                                    <a class="me-3" href="{{ route('paiements.edit', $paiement) }}">
                                        <img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    @endcan
                                    @can('paiements.delete')
                                    <form action="{{ route('paiements.destroy', $paiement) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0">
                                             <img src="{{ asset('template_assets/img/icons/delete.svg') }}" alt="img">
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun paiement trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
