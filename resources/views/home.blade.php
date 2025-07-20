@extends('layouts.main')
@section('bodyDR')
    <style>
        .product-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
    <link rel="stylesheet" href="{{ mix('css/scroll.css') }}">
    
    <div class="body-product">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="banner-body">
            <div class="sec4Card">
                <div class="imgBasic">
                    <img class="imgBShow" src="img/1.jpg" alt="">
                </div>
                <div class="imgBList">
                    <img class="imgB" src="img/1.jpg" alt="">
                    <img class="imgB" src="img/2.jpg" alt="">
                    <img class="imgB" src="img/3.jpg" alt="">
                    <img class="imgB" src="img/4.jpg" alt="">
                    <img class="imgB" src="img/5.jpg" alt="">
                    
                </div>            
                <ul>
                    <li>
                        <div id="1" class="bullet activeBullet"></div>
                    </li>
                    <li>
                        <div id="2" class="bullet"></div>
                    </li>
                    <li>
                        <div id="3" class="bullet"></div>
                    </li>
                    <li>
                        <div id="4" class="bullet"></div>
                    </li>
                    <li>
                        <div id="5" class="bullet"></div>
                    </li>
                </ul>      
            </div>
        </div>
        
        <div id="itemLoad" class="product-wrapper">
            @if ($products->count())
                @include('buyer.home.item')
            @else
                <h2>No Product</h2>
            @endif
        </div>

        <div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
            <p>
                <img class="img-fluid" src="/img/spin.gif" width="50">
            </p>
        </div>
    </div>

    <script src="{{ mix('js/scroll.js') }}"></script>
@endsection