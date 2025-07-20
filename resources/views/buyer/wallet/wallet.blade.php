@extends('layouts.main')
@section('bodyDR')

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
</style>
@section('title', 'Wallet Address')
<div class="card record-buyer-topup ">
    <div class="d-flex justify-content-center align-items-center">
        <span class="d-flex align-items-center">
            <a href="/wallet">
                <i class="fas fa-chevron-left"></i>
            </a>
        </span>            
        <p class="pt-0 mt-0 align-self-center">
            <h4 class="pt-0 my-0" style="width:100%; text-align:center;">Wallet Address</h4>
        </p>
    </div>
    <form action="{{ route('store-wallet-address') }}" method="post" class="py-3" style="">
        @csrf
        
        <div class="mb-3">
            <label for="" class="form-label">Wallet Address</label>
            <textarea class="form-control" name="wallet_address" id="wallet_address" cols="30" rows="3">{{ old('wallet_address', auth()->user()->wallet_address) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary-default w-100 mt-3 mb-3" style="background-color: orangered;color:white;">
            Update
        </button>
    </form>
</div>
@endsection