@foreach ($products as $product)
    @if ($product->stocks->count() && $product->images->count() )
        <a href="/product-detail/?product_id={{ $product->id }}&shop_id={{ $product->shop_id }}">
            <div class="product-card" categ_id="{{ $product->category_id }}">
                <div class="shop-name">
                    <span>{{ $product->shop->name }}</span>
                </div>
                <div class="product-image">
                    @if ($product->images[0]->path_file)
                        <img src="{{ url('storage/'.$product->images[0]->path_file) }}" alt="">
                    @else
                        <img src="{{ asset("/img/shopee.png") }}" alt="">
                    @endif
                </div>
                <div class="desc">
                    <h5>{{ (strlen($product->name) > 45)? substr($product->name,0,45)."..." : $product->name }}</h5>
                </div>
                <div class="price">
                    <h4>${{ floatval($product->stocks[0]->price) }}</h4>
                </div>
            </div>
        </a>
    @endif
@endforeach