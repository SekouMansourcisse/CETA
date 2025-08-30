<div class="modal fade" id="createActivityModal" tabindex="-1" aria-labelledby="createActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createActivityModalLabel">Nouvelle Activité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('activites.store') }}" method="POST" id="createActivityForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Projet</label>
                                <select name="projet_id" class="form-select @error('projet_id') is-invalid @enderror" required>
                                    <option value="">Sélectionner un projet</option>
                                    @foreach($projets as $projet)
                                        <option value="{{ $projet->id }}" {{ old('projet_id') == $projet->id ? 'selected' : '' }}>{{ $projet->titre }}</option>
                                    @endforeach
                                </select>
                                @error('projet_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Responsable</label>
                                <select name="responsable_id" class="form-select @error('responsable_id') is-invalid @enderror" required>
                                    <option value="">Sélectionner un responsable</option>
                                    @foreach($responsables as $responsable)
                                        <option value="{{ $responsable->id }}" {{ old('responsable_id') == $responsable->id ? 'selected' : '' }}>{{ $responsable->prenom }} {{ $responsable->nom }}</option>
                                    @endforeach
                                </select>
                                @error('responsable_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <input type="hidden" name="type" id="activityType" value="">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Statut</label>
                                <select name="statut" class="form-select @error('statut') is-invalid @enderror" required>
                                    <option value="planifie" selected>Planifié</option>
                                    <option value="en_cours">En cours</option>
                                    <option value="termine">Terminé</option>
                                    <option value="retard">En retard</option>
                                </select>
                                @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Date de début</label>
                                <input type="date" name="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ old('date_debut') }}" required>
                                @error('date_debut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Date de fin</label>
                                <input type="date" name="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ old('date_fin') }}" required>
                                @error('date_fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Montant Prévu (€)</label>
                                <input type="number" step="0.01" name="montant_prevu" class="form-control @error('montant_prevu') is-invalid @enderror" value="{{ old('montant_prevu') }}" required>
                                @error('montant_prevu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                         <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Montant Réalisé (€)</label>
                                <input type="number" step="0.01" name="montant_realise" class="form-control @error('montant_realise') is-invalid @enderror" value="{{ old('montant_realise', 0) }}" required>
                                @error('montant_realise') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="createActivityForm" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>