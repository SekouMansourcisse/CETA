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
                                <select name="projet_id" class="form-select select2-enable" required>
                                    <option value="">Sélectionner un projet</option>
                                    @foreach($projets as $projet)
                                        <option value="{{ $projet->id }}">{{ $projet->titre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Responsable</label>
                                <select name="responsable_id" class="form-select select2-enable" required>
                                    <option value="">Sélectionner un responsable</option>
                                    @foreach($responsables as $responsable)
                                        <option value="{{ $responsable->id }}">{{ $responsable->prenom }} {{ $responsable->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="type" id="activityType" value="">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Statut</label>
                                <select name="statut" class="form-select" required>
                                    <option value="planifie" selected>Planifié</option>
                                    <option value="en_cours">En cours</option>
                                    <option value="termine">Terminé</option>
                                    <option value="retard">En retard</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Date de début</label>
                                <input type="date" name="date_debut" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Date de fin</label>
                                <input type="date" name="date_fin" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Montant Prévu (€)</label>
                                <input type="number" step="0.01" name="montant_prevu" class="form-control" required>
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

@push('scripts')
<script>
$(document).ready(function() {
    const createModal = $('#createActivityModal');

    // 1. Initialiser Select2
    if ($.fn.select2) {
        createModal.find('.select2-enable').select2({
            placeholder: 'Sélectionner...',
            allowClear: true,
            dropdownParent: createModal
        });
    }

    // 2. Valoriser le type d'activité à l'ouverture de la modale
    createModal.on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const activityType = button.data('activity-type');

        if (activityType) {
            const modal = $(this);
            modal.find('#activityType').val(activityType);
            modal.find('.modal-title').text('Nouvelle ' + activityType.charAt(0).toUpperCase() + activityType.slice(1));
        }
    });

    // 3. Gérer la soumission du formulaire en AJAX
    $('#createActivityForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');
        const submitButton = form.closest('.modal-content').find('button[type=submit]');
        const originalButtonText = submitButton.html();

        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement...');
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        $.ajax({
            url: url,
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    createModal.modal('hide');
                    // La page est rechargée, le message flash de la session sera affiché
                    window.location.reload();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    for (const field in errors) {
                        const input = form.find(`[name="${field}"]`);
                        input.addClass('is-invalid');
                        input.closest('.form-group').append(`<div class="invalid-feedback d-block">${errors[field][0]}</div>`);
                    }
                } else {
                    alert('Une erreur inattendue est survenue. Code: ' + xhr.status);
                    console.error(xhr.responseText);
                }
            },
            complete: function() {
                submitButton.prop('disabled', false).html(originalButtonText);
            }
        });
    });

    // 4. Réinitialiser le formulaire à la fermeture de la modale
    createModal.on('hidden.bs.modal', function() {
        const form = $('#createActivityForm');
        form[0].reset();
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();
        if ($.fn.select2) {
            form.find('.select2-enable').val(null).trigger('change');
        }
    });
});
</script>
@endpush
