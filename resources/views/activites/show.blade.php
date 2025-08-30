@extends('layouts.template')

@section('content')

@php
    // Helper function to get file icon class based on extension
    function getFileIconClass($filename) {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        switch ($extension) {
            case 'pdf':
                return 'fa-file-pdf text-danger';
            case 'doc':
            case 'docx':
                return 'fa-file-word text-primary';
            case 'xls':
            case 'xlsx':
                return 'fa-file-excel text-success';
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                return 'fa-file-image text-warning';
            case 'zip':
            case 'rar':
                return 'fa-file-archive text-muted';
            default:
                return 'fa-file-alt text-secondary';
        }
    }
    $showExpenses = in_array($activite->type, ['realisation', 'autorisation']);
@endphp

<div class="page-header">
    <div class="page-title">
        <h4>Détails de l'Activité</h4>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
            <li class="breadcrumb-item"><a href="{{ route(app('App\Http\Controllers\ActiviteController')->getRedirectRouteForType($activite->type)) }}">{{ ucfirst($activite->type) }}s</a></li>
            <li class="breadcrumb-item active">Détails</li>
        </ul>
    </div>
    <div class="page-btn">
        <a href="{{ route(app('App\Http\Controllers\ActiviteController')->getRedirectRouteForType($activite->type)) }}" class="btn btn-light">Retour à la liste</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Informations sur l'activité</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Type:</strong> <span class="badge bg-info">{{ ucfirst($activite->type) }}</span></p>
                        <p><strong>Projet Associé:</strong> <a href="{{ route('projets.show', $activite->projet) }}">{{ $activite->projet->titre }}</a></p>
                        <p><strong>Responsable:</strong> {{ $activite->responsable->prenom }} {{ $activite->responsable->nom }}</p>
                        <p><strong>Statut:</strong> {{ ucfirst($activite->statut) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Date de début:</strong> {{ \Carbon\Carbon::parse($activite->date_debut)->format('d/m/Y') }}</p>
                        <p><strong>Date de fin:</strong> {{ \Carbon\Carbon::parse($activite->date_fin)->format('d/m/Y') }}</p>
                        <p><strong>Montant Prévu:</strong> {{ number_format($activite->montant_prevu, 2, ',', ' ') }} €</p>
                        @if($showExpenses)
                            <p><strong>Total des Dépenses:</strong> <span class="text-danger fw-bold">{{ number_format($totalDepenses, 2, ',', ' ') }} €</span></p>
                        @else
                            <p><strong>Montant Réalisé:</strong> {{ number_format($activite->montant_realise, 2, ',', ' ') }} €</p>
                        @endif
                    </div>
                    <div class="col-12 mt-3">
                        <h6>Description</h6>
                        <p>{{ $activite->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Actions Rapides</h5>
            </div>
            <div class="card-body">
                @can('activites.edit')
                <a href="{{ route('activites.edit', $activite) }}" class="btn btn-warning w-100 mb-2">Modifier l'activité</a>
                @endcan
                @can('activites.delete')
                <form action="{{ route('activites.destroy', $activite) }}" method="POST" class="d-inline w-100 delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">Supprimer l'activité</button>
                </form>
                @endcan
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="{{ $showExpenses ? 'col-lg-6' : 'col-lg-12' }}">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Documents Associés</h5>
                @can('documents.create')
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
                    <i class="fas fa-plus me-1"></i> Ajouter un document
                </button>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 5%;"></th>
                                <th>Nom du Document</th>
                                <th>Type</th>
                                <th>Ajouté par</th>
                                <th>Date d'ajout</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activite->documents as $document)
                                <tr>
                                    <td><i class="fas {{ getFileIconClass($document->nom) }} fa-2x"></i></td>
                                    <td>{{ $document->nom }}</td>
                                    <td><span class="badge bg-secondary">{{ ucfirst($document->type) }}</span></td>
                                    <td>{{ $document->uploadePar->prenom ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($document->date_upload)->format('d/m/Y H:i') }}</td>
                                    <td class="text-end">
                                        @if ($document->type == 'plan')
                                            <a href="{{ route('documents.download', $document) }}" class="btn btn-sm btn-outline-primary" title="Télécharger">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @else
                                            <a href="{{ Illuminate\Support\Facades\Storage::url($document->chemin_acces) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Visualiser">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endif
                                        <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="_redirect_to" value="activites.show">
                                            <input type="hidden" name="_activite_id" value="{{ $activite->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                 <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucun document associé à cette activité.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($showExpenses)
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Dépenses Associées</h5>
                    @can('depenses.create')
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                        <i class="fas fa-plus me-1"></i> Ajouter une dépense
                    </button>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Catégorie</th>
                                    <th>Date</th>
                                    <th class="text-end">Montant</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($activite->depenses as $depense)
                                    <tr>
                                        <td>{{ $depense->description }}</td>
                                        <td><span class="badge bg-info">{{ ucfirst($depense->categorie) }}</span></td>
                                        <td>{{ \Carbon\Carbon::parse($depense->date)->format('d/m/Y') }}</td>
                                        <td class="text-end">{{ number_format($depense->montant, 2, ',', ' ') }} €</td>
                                    <td class="text-end">
                                        <form action="{{ route('depenses.destroy', $depense) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="_redirect_to" value="activites.show">
                                            <input type="hidden" name="_activite_id" value="{{ $activite->id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                 <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Aucune dépense associée à cette activité.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection

@push('scripts')
<!-- Add Document Modal -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('documents.storeForActivity', $activite) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDocumentModalLabel">Ajouter un nouveau document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="document_nom" class="form-label">Nom du document</label>
                        <input type="text" class="form-control" id="document_nom" name="nom" required>
                    </div>
                    <input type="hidden" name="projet_id" value="{{ $activite->projet_id }}">
                    <input type="hidden" name="activite_id" value="{{ $activite->id }}">
                    <div class="mb-3">
                        <label for="document_type" class="form-label">Type de document</label>
                        <select class="form-select" id="document_type" name="type" required>
                            <option value="plan">Plan</option>
                            <option value="devis">Devis</option>
                            <option value="contrat">Contrat</option>
                            <option value="photo">Photo</option>
                            <option value="rapport">Rapport</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="document_fichier" class="form-label">Fichier</label>
                        <input class="form-control" type="file" id="document_fichier" name="fichier" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('depenses.storeForActivity', $activite) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addExpenseModalLabel">Ajouter une nouvelle dépense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="expense_description" class="form-label">Description</label>
                        <textarea class="form-control" id="expense_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="expense_montant" class="form-label">Montant (€)</label>
                                <input type="number" class="form-control" id="expense_montant" name="montant" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="expense_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="expense_date" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="expense_categorie" class="form-label">Catégorie</label>
                        <select class="form-select" id="expense_categorie" name="categorie" required>
                            <option value="materiel">Matériel</option>
                            <option value="deplacement">Déplacement</option>
                            <option value="formation">Formation</option>
                            <option value="logiciel">Logiciel</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush