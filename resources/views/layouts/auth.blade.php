<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Archi-Manager') }} - Connexion</title>

    <link rel="stylesheet" href="{{ asset('template_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/css/style.css') }}">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">

                    
                        @yield('content')

            </div>
        </div>
    </div>

    <script src="{{ asset('template_assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/script.js') }}"></script>
</body>

</html>
