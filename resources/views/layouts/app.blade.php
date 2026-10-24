<!doctype html>
<html lang="id" data-bs-theme="light" data-lte-color-mode="off">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Sistem Informasi Klinik</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous"
    >
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="{{ asset('adminLte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/klinik.css') }}">

    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('partials.navbar')
        @include('partials.sidebar')

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <h1 class="mb-0 fs-3">@yield('title', 'Dashboard')</h1>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body klinik-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('partials.footer')
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        crossorigin="anonymous"
    ></script>
    <script src="{{ asset('adminLte/js/adminlte.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
