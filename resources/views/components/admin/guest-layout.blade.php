<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    @stack('before-styles')
        <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
    @stack('after-styles')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        
        <div class="container-fluid">

            <x-general.flash></x-general.flash>
            
            {{ $slot }}

        </div>

    </div>

    @stack('before-scripts')
        <script src="{{ mix('js/admin.js') }}"></script>
    @stack('after-scripts')
</body>

</html>