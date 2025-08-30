@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Nouveau Projet</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('projets.index') }}">Projets</a></li>
                    <li class="breadcrumb-item active">Ajouter Projet</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('projets.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Titre du projet</label>
                            <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" value="{{ old('titre') }}" required>
                            @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Client</label>
                            <select name="client_id" class="form-select @error('client_id') is-invalid @enderror" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->societe ?? $client->prenom . ' ' . $client->nom }}</option>
                                @endforeach
                            </select>
                            @error('client_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Responsable</label>
                            <select name="responsable_id" class="form-select @error('responsable_id') is-invalid @enderror" required>
                                @foreach($responsables as $responsable)
                                    <option value="{{ $responsable->id }}" {{ old('responsable_id') == $responsable->id ? 'selected' : '' }}>{{ $responsable->prenom }} {{ $responsable->nom }}</option>
                                @endforeach
                            </select>
                            @error('responsable_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date de début</label>
                            <input type="date" name="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut') }}" required>
                            @error('date_debut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date de fin</label>
                            <input type="date" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ old('date_fin') }}" required>
                            @error('date_fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Budget Prévu (€)</label>
                            <input type="number" step="0.01" name="budget_prevu" class="form-control @error('budget_prevu') is-invalid @enderror" value="{{ old('budget_prevu') }}" required>
                            @error('budget_prevu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>État</label>
                            <select name="etat" class="form-select @error('etat') is-invalid @enderror" required>
                                <option value="planifie" {{ old('etat') == 'planifie' ? 'selected' : '' }}>Planifié</option>
                                <option value="en_attente" {{ old('etat') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="en_cours" {{ old('etat') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="termine" {{ old('etat') == 'termine' ? 'selected' : '' }}>Terminé</option>
                                <option value="suspendu" {{ old('etat') == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                            </select>
                            @error('etat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                        <a href="{{ route('projets.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
