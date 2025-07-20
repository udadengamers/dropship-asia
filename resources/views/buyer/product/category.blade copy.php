@extends('layouts.main')
@section('bodyDR')

<div class="category-container">
    <div class="d-flex align-items-start">
        <div class="categ-body">
            <div class="navigation-categ">
    
                <div class="nav-body-categ">
                    <div class="title-nav-categ">
                        <span>Category</span>
                    </div><hr>
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Show All</button>
                        
                        @foreach ($categories as $categ)
                            <button class="nav-link" id="v-pills-{{ $categ->name }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $categ->id }}" type="button" role="tab" aria-controls="v-pills-{{ $categ->name }}" aria-selected="false">{{ (strlen($categ->name) > 15)? substr($categ->name,0,15)."..." : $categ->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            
            
            <div class="tab-content " id="v-pills-tabContent" style="width:100%; ">
                <div class="tab-pane fade show active"  id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="body-product-categ" style="padding-bottom: 100px;">
                        @foreach ($products as $product)
                            @if ($product->product->stocks->count() && $product->product->product_images->count() )
                                <a href="/product-detail/?product_id={{ $product->product_id }}&shop_id={{ $product->shop_id }}">
                                    <div class="product-card" categ_id="{{ $product->product->category_id }}">
                                        <div class="shop-name">
                                            <span>{{ $product->shop->name }}</span>
                                        </div>
                                        <div class="product-image">
                                            @if ($product->product->product_images[0]->path_file)
                                            <img src="{{ url('storage/'.$product->product->product_images[0]->path_file) }}" alt="">
                                            @else
                                            <img src="{{ asset("/img/shopee.png") }}" alt="">
                                            @endif
                                            
                                        </div>
                                        <div class="desc">
                                            <h5>{{ (strlen($product->product->name) > 45)? substr($product->product->name,0,45)."..." : $product->product->name }}</h5>
                                        </div>
                                        <div class="price">
                                            <h4>${{ floatval($product->product->stocks[0]->price) }}</h4>
                                        </div>
                                    </div>
                                </a>
                                
                            @endif
                        @endforeach
                       
                    </div>
                </div>
                @foreach ($categories as $categ)
                    <div class="tab-pane fade" id="v-pills-{{ $categ->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $categ->name }}-tab">
                        <div class="body-product-categ" style="padding-bottom: 100px;">
                            @foreach ($products as $product)
                                @if ($product->product->stocks->count() && $product->product->product_images->count())
                                    @if ($categ->id == $product->product->category_id)
                                
                                        <a href="/product-detail/?product_id={{ $product->product_id }}&shop_id={{ $product->shop_id }}">
                                            <div class="product-card" categ_id="{{ $product->product->category_id }}">
                                                <div class="shop-name">
                                                    <span>{{ $product->shop->name }}</span>
                                                </div>
                                                <div class="product-image">
                                                    @if ($product->product->product_images[0]->path_file)
                                                    <img src="{{ url('storage/'.$product->product->product_images[0]->path_file) }}" alt="">
                                                    @else
                                                    <img src="{{ asset("/img/shopee.png") }}" alt="">
                                                    @endif
                                                    
                                                </div>
                                                <div class="desc">
                                                    <h5>{{ (strlen($product->product->name) > 45)? substr($product->product->name,0,45)."..." : $product->product->name }}</h5>
                                                </div>
                                                <div class="price">
                                                    <h4>${{ floatval($product->product->stocks[0]->price) }}</h4>
                                                </div>
                                            </div>
                                        </a>
                                        
                                    @endif
                                    
                                @endif
                            @endforeach
                            
                        </div>
                    </div>                    
                @endforeach
            </div>

        </div>
    </div>
    
</div>

@endsection