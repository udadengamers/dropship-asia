<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seller - @yield('title')</title>
    @stack('before-styles')
    <link rel="stylesheet" href="{{ mix('css/seller.css') }}">
    @stack('after-styles')
</head>

<body>
    <header>
        @include('components.seller.part.top_navbar')
    </header>
    <!-- Bottom Navbar -->
    @include('components.seller.part.bottom_navbar')
    <!-- Content -->
    <div class="container mt-5 mb-10">
        <div class="d-none d-md-block">
            <x-general.breadcrumb :paths="$current_path" />
        </div>
        <x-general.flash></x-general.flash>
        
        {{ $slot }}
    </div>

    @stack('before-scripts')
    <script src="{{ mix('js/seller.js') }}"></script>
    @stack('after-scripts')
</body>

</html>
