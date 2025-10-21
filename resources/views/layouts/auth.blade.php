<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kabby Admin')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link href="{{ asset('css/hope-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dark.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customizer.css') }}" rel="stylesheet">
    @stack('styles')
    
    <!-- JavaScript -->
    <script src="{{ asset('js/hope-ui.js') }}" defer></script>
    <script src="{{ asset('js/plugins/jquery.min.js') }}" defer></script>
    @stack('scripts')
</head>
<body class="bg-gray-50">
    <!-- Page Content -->
    <main class="content-wrapper">
        @yield('content')
    </main>

    <!-- Core JS -->
    <script src="{{ asset('js/core/libs.min.js') }}"></script>
    <script src="{{ asset('js/core/external.min.js') }}"></script>
    
    <!-- Plugin JS -->
    <script src="{{ asset('js/plugins/slider-tabs.js') }}"></script>
    <script src="{{ asset('js/plugins/prism.mini.js') }}"></script>
    <script src="{{ asset('js/plugins/setting.js') }}"></script>
    <script src="{{ asset('js/plugins/kanban.js') }}"></script>
    <script src="{{ asset('js/plugins/fslightbox.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr.js') }}"></script>
    <script src="{{ asset('js/plugins/form-wizard.js') }}"></script>
    <script src="{{ asset('js/plugins/circle-progress.js') }}"></script>
    <script src="{{ asset('js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('js/plugins/calender.js') }}"></script>
    
    <!-- Chart JS -->
    <script src="{{ asset('js/charts/widgetcharts.js') }}"></script>
    <script src="{{ asset('js/charts/dashboard.js') }}"></script>
    <script src="{{ asset('js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('js/charts/apexcharts.js') }}"></script>
    
    <!-- Main JS -->
    <script src="{{ asset('js/hope-ui.js') }}"></script>
</body>
</html> 