@foreach ($shop_products as $shop_product)      
    @if ($shop_product->product->stocks->count() && $shop_product->product->product_images->count())
        <a href="/product-detail/?product_id={{ $shop_product->product->id }}&shop_id={{ $shop->id}}">
            <div class="product-card p-1 m-1" style="">
                <div class="product-image">
                    @if ($shop_product->product->product_images[0]->path_file)
                        <img src="{{ url('storage/'.$shop_product->product->product_images[0]->path_file) }}" alt="">
                    @else
                        <img src="{{ asset("/img/shopee.png") }}" alt="">
                    @endif
                </div>
                <div class="desc">
                    <h5>{{ $shop_product->product->name }}</h5>
                </div>
                <div class="price">
                    <h4>${{ floatval($shop_product->product->stocks[0]->price) }}</h4>
                </div>
            </div>
        </a>
    @endif
@endforeach