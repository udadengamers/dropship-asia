@extends('layouts.main')
@section('bodyDR')
    {{-- <link rel="stylesheet" href="{{ mix('css/scroll.css') }}"> --}}
    <div class="cart-container">
        {{-- TOKEN --}}
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />{{-- DEKLARASI CSRF TOKEN UNTUK JAVA SCRIPT- --}}

        <div class="container p-3 rounded cart">
            <div class="row no-gutters">
                <div class="col-md-8">
                    <div class="product-details mr-2">
                        <div class="d-flex flex-row align-items-center"><a href="/"><i
                                    class="fa fa-long-arrow-left"></i><span class="ml-2">Continue Shopping</span></a>
                        </div>
                        <hr>
                        <h2 class="mb-0 ml-4">Your Cart</h2>

                        <div class="d-flex justify-content-between  ml-4">
                            <span>
                                {{-- You have {{ sizeof($carts) }} items in yourcart --}}
                            </span>
                        </div>
                        <div id="itemLoad">
                            @include('buyer.order.item_cart')
                            {{-- @include('buyer.order.item_cart_ori') --}}
                        </div>
                        {{-- <div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
                          <p>
                              <img class="img-fluid" src="/img/spin.gif" width="50">
                          </p>
                        </div> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="/checkout" method="POST" id="checkout-form">
                        @csrf
                        @method('POST')
                        <div class="payment-info">
                            <div class=" d-flex justify-content-between align-items-center"><span>Summary</span>
                                @if (auth()->user()->buyer_detail)
                                    @if (auth()->user()->buyer_detail->profile_pict)
                                        <img class="rounded"
                                            src="{{ url('storage/' . auth()->user()->buyer_detail->profile_pict) }}"
                                            width="30" height="30" alt="">
                                    @else
                                        <img class="rounded" src="{{ asset('/img/temp-img-profile.png') }}"
                                            width="30" alt="">
                                    @endif
                                @else
                                    <img class="rounded" src="{{ asset('/img/temp-img-profile.png') }}" width="30"
                                        alt="">
                                @endif
                            </div>

                            <hr class="line">
                            <div class="shipment-address">Shipment Destination
                                <input type="hidden" id="checking-address-checkout"
                                    addressone="{{ auth()->user()->buyer_detail?->address_one }}"
                                    addresstwo="{{ auth()->user()->buyer_detail?->address_two }}">
                                @if (auth()->user()->buyer_detail?->address_one)
                                    <p>{{ auth()->user()->buyer_detail->address_one }}</p>
                                @else
                                    @if (auth()->user()->buyer_detail?->address_two)
                                        <p>{{ auth()->user()->buyer_detail->address_two }}</p>
                                    @else
                                        <p>You dont have shipment address yet, Please add your address first <a
                                                href="/account">here</a> </p>
                                    @endif
                                @endif

                            </div>
                            <div class="result-checkout-body">
                                <div class="payment-result-desc">
                                    <div class="d-flex justify-content-between information mt-4">
                                        <span>Payment Type</span>
                                    </div>
                                    <select name="payment_type" class="form-select" id="select-payment" style="height:30px;border:none;">
                                        <option disabled selected value> -- select payment type -- </option>
                                        <option value="sp" selected>Shopee Pay ${{ auth()->user()->balance }}</option>
                                        <option value="tf">Bank Transfer</option>
                                    </select>
                                    <div class="d-flex justify-content-between information mt-4">
                                        <span>Shipment</span>
                                        <span><b id="select-shipment-cart2"></b></span>
                                    </div>
                                    <select class="mb-3 select-shipment" id="select-shipment" name="shipment">
                                        <option disabled selected value> -- select an shipment -- </option>
                                        @foreach ($shipments as $shipment)
                                            <option id="{{ $shipment->id }}" value="{{ $shipment->price }}"
                                                price="{{ $shipment->price }}">{{ $shipment->name }}
                                                ${{ $shipment->price }} ({{ $shipment->description }})</option>
                                        @endforeach
                                        <option selected class="d-none" value="0">Select shipment</option>
                                    </select>
                                    <div class="d-flex justify-content-between information">
                                        <span>Total Items</span>
                                        <span><b id="checkout-totalqty">0</b></span>
                                    </div>
                                    <div class="d-flex justify-content-between information">
                                        <span>Total Shipping</span>
                                        <span><b id="shipment-qty">0</b></span>
                                    </div>
                                    <div class="d-flex justify-content-between information">
                                        <span>Shipping</span>
                                        <span>$<b id="shipment-amount">0</b> </span>
                                    </div>
                                    <div class="d-flex justify-content-between information">
                                        <span>Subtotal</span>
                                        <span>$<b id="checkout-subtotal">0</b> </span>
                                    </div>
                                    <div class="d-flex justify-content-between information p-2" style="background-color: rgba(128, 128, 128, 0.47)">
                                        <span>Total(Incl. taxes)</span>
                                        <span>$<b id="checkout-total">0</b> </span>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" id="checkout-user-id"
                                    value="{{ auth()->user()->id }}">
                                <input type="hidden" name="total" id="checkout-input-total" value="">

                                <div class="checkout-body-button mt-3">
                                    <button class="checkout-btn" id="checkout-btn"
                                        onclick="return confirm('Are you sure to checkout now ?')"
                                        type="submit"><span>$<b id="checkout-total">0</b> </span><span> Checkout<i
                                                class="fa fa-long-arrow-right ml-1"></i></span></button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ mix('js/scroll.js') }}"></script> --}}
@endsection
