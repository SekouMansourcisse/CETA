@extends('layouts.template')

@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Notifications</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de Bord</a></li>
                    <li class="breadcrumb-item active">Liste des Notifications</li>
                </ul>
            </div>
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
                            <th>Message</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->date_envoi->format('d/m/Y H:i') }}</td>
                                <td>{{ $notification->message }}</td>
                                <td>{{ ucfirst($notification->type) }}</td>
                                <td>
                                    @if($notification->lu)
                                        <span class="badge bg-secondary">Lue</span>
                                    @else
                                        <span class="badge bg-primary">Non lue</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$notification->lu)
                                        <form action="{{ route('notifications.read', $notification) }}" method="POST" class="d-inline me-3">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0 m-0" title="Marquer comme lue">
                                                <img src="{{ asset('template_assets/img/icons/check.svg') }}" alt="img">
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('notifications.destroy', $notification) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0" title="Supprimer">
                                            <img src="{{ asset('template_assets/img/icons/delete.svg') }}" alt="img">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucune notification.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
