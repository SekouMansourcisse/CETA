@extends('layouts.auth')

@section('content')
<div class="login-userheading">
    <h3>Confirmer le mot de passe</h3>
    <h4>Veuillez confirmer votre mot de passe avant de continuer.</h4>
</div>

<div class="form-login">
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <div class="pass-group">
                <input id="password" type="password" class="pass-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <span class="fas toggle-password fa-eye-slash"></span>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-login">
            <button type="submit" class="btn btn-login">
                Confirmer le mot de passe
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>
    </form>
</div>
@endsection
