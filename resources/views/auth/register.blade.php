@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="login-userheading">
        <h3>Créer un Compte</h3>
        <h4>Continuez là où vous vous êtes arrêté</h4>
    </div>

    <div class="form-login">
        <label>Nom</label>
        <div class="form-addons">
            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
            <img src="{{ asset('template_assets/img/icons/users1.svg') }}" alt="img">
        </div>
        @error('nom')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-login">
        <label>Prénom</label>
        <div class="form-addons">
            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom">
            <img src="{{ asset('template_assets/img/icons/users1.svg') }}" alt="img">
        </div>
        @error('prenom')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-login">
        <label>Login</label>
        <div class="form-addons">
            <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login">
            <img src="{{ asset('template_assets/img/icons/users1.svg') }}" alt="img">
        </div>
        @error('login')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-login">
        <label>Email</label>
        <div class="form-addons">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            <img src="{{ asset('template_assets/img/icons/mail.svg') }}" alt="img">
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-login">
        <label>Mot de passe</label>
        <div class="pass-group">
            <input id="password" type="password" class="pass-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <span class="fas toggle-password fa-eye-slash"></span>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-login">
        <label>Confirmer le mot de passe</label>
        <div class="pass-group">
            <input id="password-confirm" type="password" class="pass-input form-control" name="password_confirmation" required autocomplete="new-password">
            <span class="fas toggle-password fa-eye-slash"></span>
        </div>
    </div>

    <div class="form-login">
        <button type="submit" class="btn btn-login">
            S'inscrire
        </button>
    </div>

    <div class="signinform text-center">
        <h4>Déjà un utilisateur ? <a href="{{ route('login') }}" class="hover-a">Se connecter</a></h4>
    </div>
</form>
@endsection