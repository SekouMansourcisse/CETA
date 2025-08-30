<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Archi-Manager') }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template_assets/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('template_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/plugins/select2/css/select2.min.css') }}">
    <!-- Whirly-loader personnalisé avec palette du login -->
    <link rel="stylesheet" href="{{ asset('resources/css/whirly-loader-login.css') }}">
    @stack('styles')
</head>
<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
        @include('layouts.partials.template._header')
        @include('layouts.partials.template._sidebar')

        <div class="page-wrapper">
            <div class="content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Succès !</strong> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur !</strong> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('template_assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template_assets/plugins/select2/js/select2.min.js') }}"></script>
    
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('scripts')
    @vite(['resources/js/app.js'])
    <script src="{{ asset('template_assets/js/script.js') }}"></script>
    
</body>
</html>
