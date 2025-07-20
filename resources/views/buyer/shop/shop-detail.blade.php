@extends('layouts.main')
@section('bodyDR')
  <div class="shop-detail-container">
    <div class="sd-bodyc">
      <div class="shop-detail-body " >
          <div class="header-shop-detail">
              <span class="bg-shop-title"></span>
              <div class="img-body-sd">
                  <img src="/img/shopee.png" alt="" ><br>
                  <h3>{{ $shop->name }}</h3>
                  <h5>{{ (strlen($shop->description)>100)? substr($shop->description,0,100)."...":$shop->description }}</h5>
              </div>
          </div>
          <div class="shop-description-detail">
            <h4>Best Product</h4>
          </div>
          <div class="produk-terlaris-shop-detail">
            <div class="shop-body-card pb-5 pt-1">                
              @forelse ($best_products as $item)
                @php $product = $item->product; @endphp
                @if ($product)
                  <div class="card-shop-product mr-3 swiper-slide">
                      <a href="/product-detail/?product_id={{ $product->id }}&shop_id={{ $shop->id }}">
                          <img src="{{ url('storage/'.$product->product_images[0]->path_file) }}" alt="">
                          <h5 style="font-size:10px ;">{{ ($product->name) }}</h5>
                          <h5>${{ ($product->stocks[0]->price) }}</h5>
                      </a>
                  </div>
                @endif  
              @empty
                <div class="row mt-4">
                    <div class="col">
                        No Products Yet.
                    </div>
                </div>              
              @endforelse
            </div>
          </div>
          <div class="shop-description-detail">
            <h4>Product</h4>
          </div>
          <div class="produk-terlaris-shop-detail">
            @include('buyer.shop.item-product')        
          </div>
      </div>
    </div>
  </div>
@endsection
