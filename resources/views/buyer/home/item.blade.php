@foreach ($products as $product)
    <input id="ids" name="ids" type="hidden" value="{{ $product->product_shop_id }}">
    <a href="/product-detail/?product_id={{ $product->id }}&shop_id={{ $product->shop_id }}">
        <div class="product-card">
            <div class="shop-name">
                <span>{{ $product->shop->name }}</span>
            </div>
            <div class="product-image">
                @if ($product->images()->first()->path_file)
                    <img src="{{ url('storage/'.$product->images()->first()->path_file) }}" alt="">
                @else
                    <img src="{{ asset("/img/shopee.png") }}" alt="">
                @endif
            </div>
            <div class="desc">
                <h5>{{ (strlen($product->name) > 45)? substr($product->name,0,45)."..." : $product->name }}</h5>
            </div>
            <div class="price">
                <h4>${{ floatval($product->stocks()->first()->price) }}</h4>
            </div>
        </div>
    </a>
@endforeach