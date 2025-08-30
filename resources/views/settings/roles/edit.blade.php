@extends('layouts.template')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h4>Édition de rôle</h4>
        <h6>Modifier les permissions du rôle</h6>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('roles.update', $role) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>Nom du Rôle</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" placeholder="Entrez le nom du rôle" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 mb-3">
                    <label class="form-label"><strong>Permissions</strong></label>
                    <div class="ms-3 d-inline-block">
                        <a href="#" id="check-all" class="text-success">Tout cocher</a> /
                        <a href="#" id="uncheck-all" class="text-danger">Tout décocher</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 20%;">MODULE</th>
                            <th>VOIR</th>
                            <th>CRÉER</th>
                            <th>MODIFIER</th>
                            <th>SUPPRIMER</th>
                            <th style="width: 10%;">TOUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $module => $permissionList)
                            <tr>
                                <td><strong>{{ ucfirst($module) }}</strong></td>
                                @php
                                    $actions = ['view', 'create', 'edit', 'delete'];
                                @endphp
                                @foreach ($actions as $action)
                                    <td>
                                        @php
                                            $permissionName = $module . '.' . $action;
                                            $permission = $permissionList->firstWhere('name', $permissionName);
                                        @endphp
                                        @if($permission)
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input permission-checkbox" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                                <td>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input select-all-row">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="col-lg-12 mt-4">
                <button type="submit" class="btn btn-submit me-2">Mettre à jour le rôle</button>
                <a href="{{ route('settings.index') }}" class="btn btn-cancel">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('check-all');
        const uncheckAll = document.getElementById('uncheck-all');
        const allCheckboxes = document.querySelectorAll('input.permission-checkbox');
        const rowCheckboxes = document.querySelectorAll('input.select-all-row');

        checkAll.addEventListener('click', function(e) {
            e.preventDefault();
            allCheckboxes.forEach(checkbox => checkbox.checked = true);
            rowCheckboxes.forEach(checkbox => checkbox.checked = true);
        });

        uncheckAll.addEventListener('click', function(e) {
            e.preventDefault();
            allCheckboxes.forEach(checkbox => checkbox.checked = false);
            rowCheckboxes.forEach(checkbox => checkbox.checked = false);
        });

        rowCheckboxes.forEach(el => {
            el.addEventListener('change', function() {
                const row = el.closest('tr');
                const permissionsInRow = row.querySelectorAll('.permission-checkbox');
                permissionsInRow.forEach(checkbox => checkbox.checked = el.checked);
            });
        });
    });
</script>
@endpush
