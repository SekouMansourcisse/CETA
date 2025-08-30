@extends('layouts.auth')

@section('content')
<div class="login-userheading">
    <h3>Vérifiez votre adresse e-mail</h3>
    <h4>Un lien de vérification a été envoyé à votre adresse e-mail.</h4>
</div>

<div class="form-login">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
        </div>
    @endif

    <p>Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification.</p>
    <p>Si vous n'avez pas reçu l'e-mail,</p>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">cliquez ici pour en demander un autre</button>.
    </form>
</div>
@endsection