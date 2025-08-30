<aside class="bg-dark text-white p-4" style="width: 280px; min-height: 100vh;">
    <h4 class="mb-4">Archi-Manager</h4>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="{{ route('home') }}" class="nav-link text-white {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Tableau de Bord
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('clients.index') }}" class="nav-link text-white {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>
                Clients
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('projets.index') }}" class="nav-link text-white {{ request()->routeIs('projets.*') ? 'active' : '' }}">
                <i class="bi bi-kanban me-2"></i>
                Projets
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('activites.index') }}" class="nav-link text-white {{ request()->routeIs('activites.*') ? 'active' : '' }}">
                <i class="bi bi-check2-square me-2"></i>
                Activités
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('depenses.index') }}" class="nav-link text-white {{ request()->routeIs('depenses.*') ? 'active' : '' }}">
                <i class="bi bi-wallet2 me-2"></i>
                Dépenses
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('paiements.index') }}" class="nav-link text-white {{ request()->routeIs('paiements.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card me-2"></i>
                Paiements
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('documents.index') }}" class="nav-link text-white {{ request()->routeIs('documents.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text me-2"></i>
                Documents
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('notifications.index') }}" class="nav-link text-white {{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                <i class="bi bi-bell me-2"></i>
                Notifications
                @php
                    $unreadCount = Auth::user()->notifications()->where('lu', false)->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge bg-danger ms-2">{{ $unreadCount }}</span>
                @endif
            </a>
        </li>
        <hr class="text-secondary">
        <li class="nav-item">
            <a href="{{ route('settings.index') }}" class="nav-link text-white {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear me-2"></i>
                Paramètres
            </a>
        </li>
    </ul>
</aside>