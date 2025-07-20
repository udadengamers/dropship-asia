@extends('layouts.main')
@section('bodyDR')
<link rel="stylesheet" href="{{ url('css/wallet.css') }}">
<link rel="stylesheet" href="{{ mix('css/scroll.css') }}">
<div class="card record-buyer-topup mb-5">
    <div class="d-flex justify-content-center align-items-center mb-3">
        <span class="d-flex align-items-center">
            <a href="/wallet">
                <i class="fas fa-chevron-left"></i>
            </a>
        </span>            
        <p class="pt-0 mt-0 align-self-center">
            <h4 class="pt-0 my-0" style="width:100%; text-align:center;">Billing Details</h4>
        </p>
    </div>
    @if ($wallets->count())
        <div id="itemLoad">
            @include('buyer.wallet.parts.item')
        </div>
    @else
        <div class="p-3">
            No Transaction in your history yet.
        </div>
    @endif
    <div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
        <p>
            <img class="img-fluid" src="/img/spin.gif" width="50">
        </p>
    </div>
</div>
<script src="{{ mix('js/scroll.js') }}"></script>
@endsection