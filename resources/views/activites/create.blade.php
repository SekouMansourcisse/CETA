@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Nouvelle Activité</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('activites.index') }}">Activités</a></li>
                    <li class="breadcrumb-item active">Ajouter Activité</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('activites.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Projet</label>
                            <select name="projet_id" class="form-select @error('projet_id') is-invalid @enderror" required>
                                @foreach($projets as $projet)
                                    <option value="{{ $projet->id }}" {{ old('projet_id') == $projet->id ? 'selected' : '' }}>{{ $projet->titre }}</option>
                                @endforeach
                            </select>
                            @error('projet_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                            <label>Type</label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="etude" {{ old('type') == 'etude' ? 'selected' : '' }}>Étude</option>
                                <option value="expertise" {{ old('type') == 'expertise' ? 'selected' : '' }}>Expertise</option>
                                <option value="realisation" {{ old('type') == 'realisation' ? 'selected' : '' }}>Réalisation</option>
                                <option value="autorisation" {{ old('type') == 'autorisation' ? 'selected' : '' }}>Autorisation</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                            <label>Montant Prévu (€)</label>
                            <input type="number" step="0.01" name="montant_prevu" class="form-control @error('montant_prevu') is-invalid @enderror" value="{{ old('montant_prevu') }}" required>
                            @error('montant_prevu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Montant Réalisé (€)</label>
                            <input type="number" step="0.01" name="montant_realise" class="form-control @error('montant_realise') is-invalid @enderror" value="{{ old('montant_realise') }}" required>
                            @error('montant_realise') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Statut</label>
                            <select name="statut" class="form-select @error('statut') is-invalid @enderror" required>
                                <option value="planifie" {{ old('statut') == 'planifie' ? 'selected' : '' }}>Planifié</option>
                                <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="termine" {{ old('statut') == 'termine' ? 'selected' : '' }}>Terminé</option>
                                <option value="retard" {{ old('statut') == 'retard' ? 'selected' : '' }}>En retard</option>
                            </select>
                            @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                        <a href="{{ route('activites.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection