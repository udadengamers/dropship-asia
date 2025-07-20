@extends('layouts.main')
@section('bodyDR')

<div class="product-detail-container">
    <div class="modal-image-zoom d-none" onclick="modalImageZoom(this)">
        <div class="body-image-zoom mt-3">
            <img class="" src="{{ asset("/img/shopee.png") }}" alt="">
        </div>
        <span style="position:fixed;width:100%; height:100vh;background-color:black;opacity:0.3;"></span>
    </div>
    
    <div class="product-detail-body">
        {{-- @if (session()->has('success'))
            <div class="row d-flex justify-content-center product-detail-message">
                <div class="alert alert-success col-lg-8" role="alert">
                    {{ session('success') }}
                </div>
            </div>    
        @endif --}}
        <div class="product-image-detail">
            {{-- @dd($product->product_images[0]) --}}
            <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="mySwiper"
                thumbs-swiper=".mySwiper2" loop="true" space-between="10" >
                @foreach ($product->product_images as $image)
                    <swiper-slide>
                        @if ($product->product_images)
                        <img onclick="zoomImagePD(this)" imgName="{{ url('storage/'.$image->path_file) }}" src="{{ url('storage/'.$image->path_file) }}" />
                        @else
                        <img src="{{ asset("/img/shopee.png") }}" alt="">
                        @endif                    
                    </swiper-slide>                
                @endforeach
            </swiper-container>
            <swiper-container class="mySwiper2" loop="true" space-between="10" slides-per-view="4" free-mode="true"
                watch-slides-progress="true">
                    @foreach ($product->product_images as $image)
                        <swiper-slide>
                            <img src="{{ url('storage/'.$image->path_file) }}" alt="">
                        </swiper-slide>                                           
                    @endforeach                
            </swiper-container>            

        </div>
        <div class="product-description-detail">
            <div class="product-title-detail">
                <div class="product-name-detail">
                    <h3>{{ $product->name }}</h3>
                </div>
                <div class="shop-seller-detail">
                    <h4><a class="nav-link" href="{{ url('/shop/' . $shop->slug) }}">{{ $shop->name }}</a></h4>                             
                </div>
                <div class="hr-detail"></div>
            </div>
            <div class="produc-desc-info">                
                <div class="price-detail-body">
                    <h3>$<prc class="price-detail">{{ $stocks[0]->price }}</prc></h3>                
                </div>
                <div class="stock-detail-body">
                    <h5><b>Stock : </b><span></span> pcs</h5>
                </div>
                <div class="prod-desc">
                    <h5><b>Description </b> </h5>
                    <p>{!! $product->description !!}</p>
                </div>
                <form action="/add-to-cart" method="POST" id="add-to-cart">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}" class="product-id-detail"> 
                    <input type="hidden" name="shop_id" value="{{ $shop->id }}" class="product-id-detail"> 
                    @auth
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" class="user-id-detail"> 
                    @else
                    <input type="hidden" name="user_id" value="0" class="user-id-detail"> 
                    @endauth
                    <div class="varian-detail-body">
                        <h5> <b>Varian</b> </h5>
                        <ul>
                            @foreach ($stocks as $stock)
                            <li>
                                <label id="label-variant-pdetail" class="" for="{{ $stock->name }}" onclick="buynowvariantbasic(this)" price="{{ $stock->price }}" stock="{{ $stock->quantity }}">{{ $stock->name }}</label>
                                <input class="variant-radio-pdtail d-none" type="radio" id="{{ $stock->name }}" value="{{ $stock->id }}" name="stock_id" price="{{ $stock->price }}" stock="{{ $stock->quantity }}">
                            </li>                                
                            @endforeach                            
                        </ul> 
                    </div>

                    <div class="quantity-detail-body mb-4">
                        <h5><b>Quantity</b> </h5>
                        <div class="quantity-detail">
                            <button class="decrease-detail">-</button>
                            <input type="number" name="quantity" class="quantity-detail-product" value=1 readonly>
                            <button class="increase-detail">+</button> <br>
                        </div>
                    </div>
                    @auth
                        @if ( auth()->user()->id != $shop->user_id )
                            <div class="button-detail-body">
                                <button type="submit" class="addtocart-button-detail" >Add to cart <i style="color:grey ; font-size:20px;" class="bi bi-cart4"></i></button>
                            </div>                        
                        @endif                    
                    @endauth                  
                        
                
                </form>
                {{-- @auth
                    <input type="hidden" id="cekUserIsSeller" value="{{ auth()->user()->id }}">
                    <input type="hidden" id="cekShopId" value="{{ $shop->user_id }}">
                @endauth --}}
                @auth
                @if ( auth()->user()->id != $shop->user_id )
                    <form action="/" class="buy-now-body">
                        <button type="button" class="buynow-button-detail" onclick="buynowmodal()">Buy Now</button>
                    </form>                    
                @endif                    
                @endauth 
            </div>

        </div>
        
    </div>
</div>
{{------------------------- BUY NOW MODAL ---------------------}}
<div class="buy-now-modal-checkout d-none" id="buy-now-modal-checkout">
    <span class="buy-now-background-modal"></span>
    <div class="modal-buy-now mt-5">
        <div class="close" id="close-modal-buy-now" onclick="closemodalbuynow()" >
            <i class="bi bi-x-lg " style="font-size:20px "></i>
        </div>
        <h3 class="mt-0" style="width: 90%">{{ (strlen($product->name) > 30)? substr($product->name,0,30)."..." : $product->name }}</h3><hr>
        <form action="/checkout/buynow" method="POST" class="buy-now-form">
            @csrf
            @method('POST')
            <h5>Variant</h5>
            <div class="variant-buy-now ">
                @foreach ($stocks as $stock)
                    <div class="form-check">
                        <input class="form-check-input d-none radio-variant-buy-now" type="radio" name="stock_id" value="{{ $stock->id }}" id="buy-now-variant{{ $stock->id }}">
                        <label class="form-check-label p-1" id="buy-now-label-variant" style="border:1px solid orangered;user-select: none;" for="buy-now-variant{{ $stock->id }}" onclick="buynowvariant(this)" stock="{{ $stock->quantity }}" price="{{ $stock->price }}">
                            {{ $stock->name }}
                        </label>
                    </div>                    
                @endforeach
            </div>
            <h5>Quantity</h5>
            <div class="quantity-buy-now ml-3" style="display: flex;" >
                <div class="bnq-body" style="width:110px;heigh:auto;border:1px solid orangered;user-select: none;">
                    <button type="button" class="quantity-button" onclick="buttonQuantity(this)">-</button>
                    <input type="number" class="quantity-number-value" name="quantity" value="1">
                    <button type="button" class="quantity-button" onclick="buttonQuantity(this)">+</button>
                </div>
                <i class="ml-3 p-2" id="stock-left-bn">{{ $stocks[0]->quantity }}</i><i class="p-2">left</i>
            </div>
            <h5>Payment Type</h5>
            <select name="payment_type" class="form-select" id="select-payment">
                <option disabled>-- select payment type --</option>
                <option value="sp" selected>Shopee Pay $ {{ auth()->user() ? auth()->user()->balance : 0 }}</option>
                <option value="tf">Bank Transfer</option>
            </select>
            <h5>Shipment</h5>
            <div class="shipment-buy-now">
                <select name="shipment_id" id="shipment-select-buy-now" class="form-select" >
                    @foreach ($shipments as $shipment)
                        <option price="{{ $shipment->price }}" value="{{ $shipment->id }}">{{ $shipment->name }} ${{ $shipment->price }} ( {{ $shipment->description }} )</option>
                        
                    @endforeach
                    <option class="d-none" price="0" value="0" selected>Select shipment</option>
                </select>
            </div>
            <h5 for="note-for-seller-bn">Note for seller</h5>
            <div class="mb-3">
                <textarea class="form-control" name="note" style="height:50px;resize:none;" id="note-for-seller-bn" rows="3"></textarea>
            </div>
            @auth
            <input type="hidden" id="checking-address-checkout" addressone="{{ auth()->user()->buyer_detail?->address_one }}" addresstwo="{{ auth()->user()->buyer_detail?->address_two }}">
                
            @endauth
            
            <input type="hidden" id="bn-product_id" name="product_id" value="{{ $product->id }}">
            <input type="hidden" id="bn-shop_id" name="shop_id" value="{{ $shop->id }}">
            <input type="hidden" id="bn-total" name="total" value="">
            <button type="submit" class="bnbcheckout" onclick="return confirm('Sure to checkout now ?')">$<span id="totalinner-bn">0</span> Checkout <i class="fa fa-long-arrow-right ml-1"></i></button>
        </form>
    </div>
</div>
@endsection


