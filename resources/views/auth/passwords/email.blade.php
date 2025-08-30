@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="login-userheading">
        <h3>Mot de passe oublié ?</h3>
        <h4>Pas de panique ! Entrez l'adresse e-mail <br> associée à votre compte.</h4>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="form-login">
        <label>Email</label>
        <div class="form-addons">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <img src="{{ asset('template_assets/img/icons/mail.svg') }}" alt="img">
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-login">
        <button type="submit" class="btn btn-login">
            Envoyer le lien de réinitialisation
        </button>
    </div>
</form>
@endsection