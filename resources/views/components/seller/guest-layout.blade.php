<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Seller - @yield('title')</title>

    @stack('before-styles')
    <link rel="stylesheet" href="{{ mix('css/seller.css') }}">
    @stack('after-styles')
</head>

<body class="bg-light">
    <div class="container">
        <x-general.flash></x-general.flash>
        {{ $slot }}
    </div>
    @stack('before-scripts')
    <script src="{{ mix('js/seller.js') }}"></script>
    @stack('after-scripts')
</body>

</html>
