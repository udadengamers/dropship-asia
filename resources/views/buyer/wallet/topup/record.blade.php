<link rel="stylesheet" href="{{ mix('css/wallet.css') }}">
<link rel="stylesheet" href="{{ mix('css/scroll.css') }}">
<style>
    @media (max-width: 767.98px) {
        .container {
            max-width: 100%!important;
            padding: 0px;
        }
        /* .row > * {
            padding: 0px;
        }

        .row {
            margin-right: 0px;
        } */
    }
    #buyer .navbar .navbar-nav .nav-link {
        color: rgb(52, 52, 52)!important;
    }
    #buyer li {
        white-space: nowrap;
    }
    #buyer ul {
        padding-bottom: 5px;
    }
    #buyer .navbar .nav-link.active {
        display: inline-block;
        position: relative;
        background: none;
        color: #f53d2d;
    }

    #buyer .navbar .nav-link.active::after {
        content: "";
        display: block;
        width: 100%;
        border-bottom: 3px solid #f53d2d;
        position: absolute;
        left: 0;
        bottom: -0.2em;
    }
</style>
@extends('layouts.main')
@section('bodyDR')
    <div class="card record-buyer-topup ">
        <div class="d-flex justify-content-center align-items-center">
            <span class="d-flex align-items-center">
                <a href="/wallet">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </span>            
            <p class="pt-0 mt-0 align-self-center">
                <h4 class="pt-0 my-0" style="width:100%; text-align:center;">Recharge Records</h4>
            </p>
        </div>        
        <div id="buyer">
            <nav class="navbar navbar-expand navbar-light bg-white mb-0">
                <div style="overflow-x: auto">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0 ">
                        <li class="nav-item" role="presentation" style="padding-left: 12px;">
                            <a href="{{ route('topup-record') }}" class="nav-link {{ in_array(request()->get('tab'),['']) ? 'active' : '' }}" role="button" aria-pressed="true">All</a>
                        </li>
                        <li class=" nav-item" role="presentation" style="padding-left: 12px;">
                            <a href="{{ route('topup-record', ['tab' => 'approved']) }}" class="nav-link {{ request()->get('tab') == 'approved' ? 'active' : '' }}" role="button" aria-pressed="true">Examination Passed</a>
                        </li>
                        <li class=" nav-item" role="presentation" style="padding-left: 12px;">
                            <a href="{{ route('topup-record', ['tab' => 'in_review']) }}" class="nav-link {{ request()->get('tab') == 'in_review' ? 'active' : '' }}" role="button" aria-pressed="true">Under Review</a>
                        </li>
                        <li class="nav-item" role="presentation" style="padding-left: 12px;">
                            <a href="{{ route('topup-record', ['tab' => 'rejected']) }}" class="nav-link {{ request()->get('tab') == 'rejected' ? 'active' : '' }}" role="button" aria-pressed="true">Rejected</a>
                        </li>
                        <li class="nav-item" role="presentation" style="padding-left: 12px;">
                            <a href="{{ route('topup-record', ['tab' => 'fail']) }}" class="nav-link {{ request()->get('tab') == 'fail' ? 'active' : '' }}" role="button" aria-pressed="true">Fail</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div id="itemLoad">
            @if ($records->count())
                @include('buyer.wallet.topup.item')
            @else
                <div class="p-3">
                    No Transaction in your history yet.
                </div>
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