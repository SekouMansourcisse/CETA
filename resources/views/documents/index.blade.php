@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h4>Documents</h4>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item active">Liste des Documents</li>
            </ul>
        </div>
        <div class="page-btn">
            <a href="{{ route('documents.create') }}" class="btn btn-added"><img src="{{ asset('template_assets/img/icons/plus.svg') }}" alt="img" class="me-1">Uploader un Document</a>
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
            @if ($documents->isEmpty())
                <div class="alert alert-info text-center" role="alert">
                    Aucun document trouvé. Cliquez sur "Uploader un Document" pour en ajouter un.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Date d'upload</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr>
                                    <td>{{ $document->nom }}</td>
                                    <td>{{ $document->date_upload }}</td>
                                    <td>
                                        <a class="me-3" href="{{ route('documents.download', $document) }}">
                                            <img src="{{ asset('template_assets/img/icons/download.svg') }}" alt="img">
                                        </a>
                                        <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="_redirect_to" value="documents.index">
                                            <button type="submit" class="btn btn-link p-0 m-0">
                                                 <img src="{{ asset('template_assets/img/icons/delete.svg') }}" alt="img">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $documents->links() }}
            @endif
        </div>
    </div>
@endsection