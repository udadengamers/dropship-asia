<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="og:image" content="{{ url('img/icon_shopify.svg') }}"> --}}
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ url('img/shopee.png') }}" type="image/icon type" >
    <style>
        .btn-primary-default {
            --bs-btn-color: #fff;
            --bs-btn-bg: #f53d2d;
            --bs-btn-border-color: #f53d2d;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #d73627;
            --bs-btn-hover-border-color: #d22313;
            --bs-btn-focus-shadow-rgb: 49, 132, 253;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #d22313;
            --bs-btn-active-border-color: #bb1e10;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #f53d2d;
            --bs-btn-disabled-border-color: #f53d2d;
        }
    </style>

    {{----------- LINK RESOURCE HEADER --------}}
    @include('main-partial.headerlink')
    {{-- ----------------------------------- --}} 

</head>
<body>
    {{----------------- NAVBAR ----------------}}
        @include('main-partial.navbar')

    {{--------------- BUYER BODY --------------}}
    <div class="menu-container">
        {{-- Body --}}
        <div class="body-container">    
            <div class="notif-x" style="width: 100%;display:inline-block;text-align:center;">
                <div class="notif-x-body">
                    <x-general.flash></x-general.flash>
                </div>
            </div>        

            @yield('bodyDR') 

            {{-- MODAL NOTIF --}}
            <div class="modal-alert d-none">
                <div class="alert-bg"></div>
                <div class="card-notice">
                <i class="bi bi-x-lg"></i>
                <div class="notice-message d-flex justify-content-center" style="width:100%;">
                    <p class="d-flex justify-content-center p-4">ALERT MESSAGE HERE</p>
                </div>
                </div>
            </div>    
        </div>
        <span class="bg-main"></span>
        
    </div>
    <div class="mainMenuButton">
        @include('main-partial.mainMenuButton')
    </div>
    


    {{--------- LINK RESOURCE JAVASCRIPT---- --}}
    @include('main-partial.footerlink')
    {{-- ----------------------------------- --}}
   
</body>
</html>