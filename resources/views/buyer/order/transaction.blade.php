@extends('layouts.main')
@section('bodyDR')
    <div class="order-page-body">
        <div class="transaction-container">
            <div class="transaction-body">
                @include('buyer.order.order')
    
            </div>
        </div>
    </div>
  @endsection