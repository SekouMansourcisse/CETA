@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Enregistrer un Paiement</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('paiements.index') }}">Paiements</a></li>
                    <li class="breadcrumb-item active">Nouveau Paiement</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('paiements.store') }}" method="POST">
                @csrf
                <div class="row">
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
                            <label>Projet Associé</label>
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
                            <label>Date du paiement</label>
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                            <label>Moyen de Paiement</label>
                            <select name="moyen_paiement" class="form-select @error('moyen_paiement') is-invalid @enderror" required>
                                <option value="virement" {{ old('moyen_paiement') == 'virement' ? 'selected' : '' }}>Virement</option>
                                <option value="cheque" {{ old('moyen_paiement') == 'cheque' ? 'selected' : '' }}>Chèque</option>
                                <option value="especes" {{ old('moyen_paiement') == 'especes' ? 'selected' : '' }}>Espèces</option>
                                <option value="carte" {{ old('moyen_paiement') == 'carte' ? 'selected' : '' }}>Carte</option>
                                <option value="autre" {{ old('moyen_paiement') == 'autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('moyen_paiement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Référence (n° chèque, transaction...)</label>
                            <input type="text" name="reference_paiement" class="form-control @error('reference_paiement') is-invalid @enderror" value="{{ old('reference_paiement') }}">
                            @error('reference_paiement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
