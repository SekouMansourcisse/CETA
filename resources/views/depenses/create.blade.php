@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Nouvelle Dépense</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('depenses.index') }}">Dépenses</a></li>
                    <li class="breadcrumb-item active">Ajouter Dépense</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('depenses.store') }}" method="POST">
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
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" required>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Montant (€)</label>
                            <input type="number" step="0.01" name="montant" class="form-control @error('montant') is-invalid @enderror" value="{{ old('montant') }}" required>
                            @error('montant') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Catégorie</label>
                            <select name="categorie" class="form-select @error('categorie') is-invalid @enderror" required>
                                <option value="materiel" {{ old('categorie') == 'materiel' ? 'selected' : '' }}>Matériel</option>
                                <option value="deplacement" {{ old('categorie') == 'deplacement' ? 'selected' : '' }}>Déplacement</option>
                                <option value="formation" {{ old('categorie') == 'formation' ? 'selected' : '' }}>Formation</option>
                                <option value="logiciel" {{ old('categorie') == 'logiciel' ? 'selected' : '' }}>Logiciel</option>
                                <option value="autre" {{ old('categorie') == 'autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('categorie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                        <a href="{{ route('depenses.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection