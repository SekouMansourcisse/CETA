@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="login-userheading">
        <h3>Réinitialiser le mot de passe</h3>
        <h4>Entrez votre nouvelle mot de passe.</h4>
    </div>

    <div class="form-login">
        <label>Email</label>
        <div class="form-addons">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
            Réinitialiser le mot de passe
        </button>
    </div>
</form>
@endsection
