@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Dépenses</h4>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item active">Liste des Dépenses</li>
            </ul>
        </div>
        <div class="page-btn">
            <a href="{{ route('depenses.create') }}" class="btn btn-added"><img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">Nouvelle Dépense</a>
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
                            <th>Description</th>
                            <th>Projet</th>
                            <th>Catégorie</th>
                            <th>Montant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($depenses as $depense)
                            <tr>
                                <td>{{ $depense->date }}</td>
                                <td>{{ $depense->description }}</td>
                                <td><a href="{{ route('projets.edit', $depense->projet) }}">{{ $depense->projet->titre }}</a></td>
                                <td>{{ ucfirst($depense->categorie) }}</td>
                                <td>{{ number_format($depense->montant, 2, ',', ' ') }} €</td>
                                <td>
                                    <a class="me-3" href="{{ route('depenses.edit', $depense) }}">
                                        <img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="img">
                                    </a>
                                    <form action="{{ route('depenses.destroy', $depense) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="_redirect_to" value="depenses.index">
                                        <button type="submit" class="btn btn-link p-0 m-0">
                                             <img src="{{ asset('template_assets/img/icons/delete.svg') }}" alt="img">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune dépense trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
