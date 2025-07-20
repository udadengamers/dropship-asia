
@foreach ($shops as $shop)
<div class="card-shop-mall">
    <div class="shop-header-card">
        @if ($shop->profile_picture)
            <img src="{{ url('storage/'.$shop->profile_picture) }}" alt="">
        @else
            <img src="/img/shopee.png" alt="">
        @endif   
        <div class="shop-title-mall">
            <h4><a href="/shop/detail/{{ $shop->uuid }}">{{ (strlen($shop->name) > 25)? substr($shop->name,0,25)."..." : $shop->name }}</a></h4>
            <p style="font-size:13px ; margin-top:5px;">{{ (strlen($shop->description)>60)? substr($shop->description,0,60)."...":$shop->description }}</p>
        </div>
    </div>
    <div class="shop-body-card ">  
        @php 
            $shop_products = $shop->shop_products()->added()->productActive()->get()->take(11);
        @endphp               
        @forelse ($shop_products as $shop_product)
            @if ($shop_product->product->stocks->count() && $shop_product->product->product_images->count())
                <div class="card-shop-product mr-3 swiper-slide">
                    <a href="/product-detail/?product_id={{ $shop_product->product->id }}&shop_id={{ $shop->id }}">
                        <img src="{{ url('storage/'.$shop_product->product->product_images[0]->path_file) }}" alt="">
                        <h5 style="font-size:10px ;">
                            @php
                                if (strlen($shop_product->product->name) > 25) {
                                    echo substr($shop_product->product->name,0,25)."...";
                                }else{
                                    echo $shop_product->product->name;
                                }
                            @endphp

                        </h5>
                        <h5>${{ ($shop_product->product->stocks[0]->price) }}</h5>
                    </a>
                </div>                            
            @endif  
        @empty
            <div style="width:100%;height:100%;display:flex;justify-content:center;padding-top:30px;">
                <h5>This Shop has no product yet</h5>                      
                
            </div>
        @endforelse
    </div>
</div>            
@endforeach