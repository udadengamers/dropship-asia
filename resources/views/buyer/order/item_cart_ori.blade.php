<?php
    // $qty=0;
    // $prctotal=0;
    $arrCartShops = [];
    for ($i = 0; $i < sizeof($carts); $i++) {
        array_push($arrCartShops, $carts[$i]->shop_id);
    }
    $arr = $arrCartShops;
    $shop_carts = [];
    for ($i = 0; $i < sizeof($arr); $i++) {
        $sum = 0;
        for ($j = 0; $j < $i; $j++) {
            if ($arr[$i] == $arr[$j]) {
                $sum += 1;
            }
        }
        if ($sum < 1) {
            array_push($shop_carts, $arr[$i]);
        }
        $sum = 0;
    }
?>
@foreach ($shop_carts as $sc)
    <div class="cart-shop-body">
        @foreach ($carts as $cart)
            @if ($cart->shop->id == $sc)
                <input type="checkbox" class="form-check-input shop-name-cart-chkbox" name=""
                    id="shop-name-cart-chkbox" value="shop_id{{ $cart->shop->id }}"
                    shopid="{{ $cart->shop->id }}">
                <label value="shop_id{{ $cart->shop->id }}" class="cart-shop-name"
                    id="cart-shop-label">{{ $cart->shop->name }}</label>
                <hr>
                <?php break; ?>
            @endif
        @endforeach

        @foreach ($carts as $cart)
            @if ($cart->stock)                                    
                @if ($cart->stock->quantity != 0)
                    <?php if ($cart->shop_id == $sc ) { ?>
                    {{-- <input type="hidden" id="shop-name-val" value="{{ $cart->shop->name }}">    --}}
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items items-cart rounded card-item-cart" id="shop_id{{ $cart->shop->id }}">
                        <input type="checkbox" class="form-check-input" cartID="{{ $cart->id }}" qty="{{ $cart->quantity }}"  cart="item" name="" id="shop_id{{ $cart->shop->id }}" value="{{ $cart->id }}" disabled>
                        <div class="d-flex flex-row"><img class="rounded ml-5" src="{{ url('storage/'.$cart->product->product_images[0]->path_file) }}" width="40">
                            <div class="ml-2"><span class="prd-name-cart font-weight-bold mr-1 d-block">{{ $cart->product->name }}</span><span class="spec">{{ $cart->stock->name }}</span></div>
                        </div>
                        {{-- Delete Product --}}
                        <input type="hidden" id="cart-shopid" value="{{ $cart->shop_id}}">
                        <div class="qty-cart-body">
                            <button id="dec-qtycart-btn" class="dec-qtycart-btn" onclick="ItemQtyChange(this)" stock="{{ $cart->stock->quantity }}" baseprc="{{ $cart->stock->price }}" crt-id="{{ $cart->id }}">-</button>
                            <input type="number" name="quantity" id="item-qty-val" value="{{ $cart->quantity }}" readonly>
                            <button id="inc-qtycart-btn" class="inc-qtycart-btn" onclick="ItemQtyChange(this)" stock="{{ $cart->stock->quantity }}" baseprc="{{ $cart->stock->price }}" crt-id="{{ $cart->id }}">+</button>
                        </div>
                        <input type="hidden" id="item-prc-val" value="{{ floatval(($cart->stock->price)*($cart->quantity)) }}">
                        <input type="hidden" id="cart-sellerid" value="{{ $cart->shop->seller_id }}">
                        <form action="/cart-delete/{{ $cart->id }}" method="POST">
                            @method('delete')
                            @csrf
                            <div class="d-flex flex-row align-items-center "><span class="d-block"></span><span class="d-block ml-5 font-weight-bold ">$<span id="prc-item-cart-spawn">{{ floatval(($cart->stock->price)*($cart->quantity)) }}</span>  </span><button type="submit" class="delete-cart-button" onclick="return confirm('Hapus Produk ?')"><i class="fa fa-trash-o ml-3 text-black-50"></i></button></div>
                        </form>
                    </div>

                    <?php 
                        }
                        // $qty += $cart->quantity;
                        // $prctotal += ($cart->stock->price)*($cart->quantity);
                    ?>
                    
                @endif
            @endif
        @endforeach
        <div class="note-for-seller">
            <i class="trigger-open-note" style="user-select: none;">Write a note for seller</i>
            <div class="noteforseller-body d-none">
                <textarea name="note" id="noteforseller"  class="noteforseller"></textarea>
                <button class="mt-3" onclick="submitandclosenote(this)">Submit</button><button class="mt-3" onclick="closeandclearnote(this)">Cancel</button>
            </div>
        </div>
    </div>
@endforeach