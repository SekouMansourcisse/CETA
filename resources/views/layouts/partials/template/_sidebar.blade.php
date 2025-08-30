<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}"><img src="{{ asset('template_assets/img/icons/dashboard.svg') }}" alt="img"><span> Accueil</span> </a>
                </li>

                <li class="{{ request()->routeIs('clients.*') ? 'active' : '' }}">
                    <a href="{{ route('clients.index') }}"><img src="{{ asset('template_assets/img/icons/users1.svg') }}" alt="img"><span> Clients</span> </a>
                </li>

                <li class="{{ request()->routeIs('projets.*') ? 'active' : '' }}">
                    <a href="{{ route('projets.index') }}"><img src="{{ asset('template_assets/img/icons/product.svg') }}" alt="img"><span> Projets</span> </a>
                </li>

                @php
                    $isRealisationActive = false;
                    if (request()->routeIs('realisations.index') || (request()->routeIs(['activites.show', 'activites.edit']) && ($activite->type ?? null) === 'realisation')) {
                        $isRealisationActive = true;
                    }
                @endphp
                <li class="{{ $isRealisationActive ? 'active' : '' }}">
                    <a href="{{ route('realisations.index') }}"><img src="{{ asset('template_assets/img/icons/plus-circle.svg') }}" alt="img"><span> Réalisation</span> </a>
                </li>
                @php
                    $isEtudeActive = false;
                    if (request()->routeIs('etudes.index') || (request()->routeIs(['activites.show', 'activites.edit']) && ($activite->type ?? null) === 'etude')) {
                        $isEtudeActive = true;
                    }
                @endphp
                <li class="{{ $isEtudeActive ? 'active' : '' }}">
                    <a href="{{ route('etudes.index') }}"><img src="{{ asset('template_assets/img/icons/edit.svg') }}" alt="img"><span> Étude</span> </a>
                </li>
                @php
                    $isExpertiseActive = false;
                    if (request()->routeIs('expertises.index') || (request()->routeIs(['activites.show', 'activites.edit']) && ($activite->type ?? null) === 'expertise')) {
                        $isExpertiseActive = true;
                    }
                @endphp
                <li class="{{ $isExpertiseActive ? 'active' : '' }}">
                    <a href="{{ route('expertises.index') }}"><img src="{{ asset('template_assets/img/icons/search.svg') }}" alt="img"><span> Expertise</span> </a>
                </li>
                @php
                    $isAutorisationActive = false;
                    if (request()->routeIs('autorisations.index') || (request()->routeIs(['activites.show', 'activites.edit']) && ($activite->type ?? null) === 'autorisation')) {
                        $isAutorisationActive = true;
                    }
                @endphp
                <li class="{{ $isAutorisationActive ? 'active' : '' }}">
                    <a href="{{ route('autorisations.index') }}"><img src="{{ asset('template_assets/img/icons/plus-circle.svg') }}" alt="img"><span> Autorisation</span> </a>
                </li>


                <li class="{{ request()->routeIs('paiements.*') ? 'active' : '' }}">
                    <a href="{{ route('paiements.index') }}"><img src="{{ asset('template_assets/img/icons/debitcard.svg') }}" alt="img"><span> Paiements</span> </a>
                </li>

                <li class="{{ request()->routeIs('documents.*') ? 'active' : '' }}">
                    <a href="{{ route('documents.index') }}"><img src="{{ asset('template_assets/img/icons/pdf.svg') }}" alt="img"><span> Documents</span> </a>
                </li>

                <li class="{{ request()->routeIs('conversations.*') ? 'active' : '' }}">
                     <a href="{{ route('conversations.index') }}"><img src="{{ asset('template_assets/img/icons/notification-bing.svg') }}" alt="img"><span> Messagerie</span> </a>
                </li>

                <li class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}"><img src="{{ asset('template_assets/img/icons/settings.svg') }}" alt="img"><span> Paramètres</span> </a>
                </li>

                @if(Auth::user()->role == 'admin')
                <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}"><img src="{{ asset('template_assets/img/icons/users1.svg') }}" alt="img"><span> Gestion utilisateur</span> </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
