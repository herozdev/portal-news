<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Portal News | {{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    {{-- Plugins Style --}}
    @if (isset($pluginStyles) && is_array($pluginStyles))
        @foreach ($pluginStyles as $style)
            <link rel="stylesheet" href="{{ $style }}">
        @endforeach
        
    @endif

    <!-- Template Main CSS File -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    {{-- Custom Style --}}
    @if (isset($afterStyles) && is_array($afterStyles))
        @foreach ($afterStyles as $style)
            <link rel="stylesheet" href="{{ $style }}">
        @endforeach
    @endif

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @include('partials._header_admin')

    @include('partials._sidebar_admin')

    <main id="main" class="main">

        @yield('content')

    </main><!-- End #main -->

    @include('partials._footer_admin')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- Plugins Script --}}
    @if (isset($pluginScripts) && is_array($pluginScripts))
        @foreach ($pluginScripts as $script)
            <script src="{{ $script }}"></script>
        @endforeach
    @endif

    <!-- Vendor JS Files -->
    <script src="{{ asset('admin/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('admin/js/main.js') }}"></script>

    {{-- Custom Script --}}
    @if (isset($afterScripts) && is_array($afterScripts))
        @foreach ($afterScripts as $script)
            <script src="{{ $script }}"></script>
        @endforeach
    @endif

</body>

</html>
