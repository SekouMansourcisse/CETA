@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Modifier le Client</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Clients</a></li>
                    <li class="breadcrumb-item active">Modification</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('clients.update', $client) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Type de Client (always visible) -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Type de Client</label>
                            <select class="form-select @error('type_client') is-invalid @enderror" name="type_client" id="clientType" required>
                                <option value="particulier" {{ old('type_client', $client->type_client) == 'particulier' ? 'selected' : '' }}>Particulier</option>
                                <option value="entreprise" {{ old('type_client', $client->type_client) == 'entreprise' ? 'selected' : '' }}>Entreprise</option>
                                <option value="collectivite" {{ old('type_client', $client->type_client) == 'collectivite' ? 'selected' : '' }}>Collectivité</option>
                            </select>
                             @error('type_client') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Nom (always visible, label changes) -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label id="nomLabel">Nom</label>
                            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $client->nom) }}" required>
                            @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Prénom (dynamically visible) -->
                    <div class="col-lg-4 col-sm-6 col-12" id="prenomGroup">
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="prenom" id="prenomInput" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', $client->prenom) }}">
                            @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Email (always visible) -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $client->email) }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Téléphone (always visible) -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone', $client->telephone) }}">
                            @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Adresse (always visible) -->
                     <div class="col-lg-8 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Adresse</label>
                            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse', $client->adresse) }}">
                            @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <input type="hidden" name="societe" value="{{ old('societe', $client->societe) }}">

                    

                    <!-- Submit/Cancel buttons -->
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary me-2">Mettre à jour</button>
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clientTypeSelect = document.getElementById('clientType');
        const prenomGroup = document.getElementById('prenomGroup');
        const prenomInput = document.getElementById('prenomInput');
        const nomLabel = document.getElementById('nomLabel');

        function togglePrenomField() {
            const selectedType = clientTypeSelect.value;
            if (selectedType === 'particulier') {
                prenomGroup.style.display = 'block';
                prenomInput.setAttribute('required', 'required');
                nomLabel.textContent = 'Nom';
            } else {
                prenomGroup.style.setProperty('display', 'none', 'important');
                prenomInput.removeAttribute('required');
                nomLabel.textContent = 'Nom de l\'entreprise/collectivité';
            }
        }

        // Initial call to set the correct state on page load
        togglePrenomField();

        // Listen for changes
        clientTypeSelect.addEventListener('change', togglePrenomField);
    });
</script>
@endpush
