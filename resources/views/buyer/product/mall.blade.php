@extends('layouts.main')
@section('bodyDR')
    <link rel="stylesheet" href="{{ mix('css/scroll.css') }}">
    <div class="mall-container">
        <div id="itemLoad" class="body-mall">

            @include('buyer.product.item-mall')

        </div>
        <div class="ajax-load mt-3 p-3 mb-2" style="display:none; text-align:center;">
            <p>
                <img class="img-fluid" src="/img/spin.gif" width="50">
            </p>
        </div>
    </div>
    <script src="{{ mix('js/scroll.js') }}"></script>
@endsection