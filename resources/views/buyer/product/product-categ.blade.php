@extends('layouts.main')
@section('bodyDR')
    @foreach ($products as $product)
        <a href="/product-detail/?product_id={{ $product->product_id }}&shop_id={{ $product->shop_id }}">
            <div class="product-card" categ_id="{{ $product->product->category_id }}">
                <div class="shop-name">
                    <span>{{ $product->shop->name }}</span>
                </div>
                <div class="product-image">
                    @if ($product->product->product_images[0]->path_file)
                    <img src="{{ $product->product->product_images[0]->path_file }}" alt="">
                    @else
                    <img src="{{ asset("/img/shopee.png") }}" alt="">
                    @endif
                    
                </div>
                <div class="desc">
                    <h5>{{ $product->product->name }}</h5>
                </div>
                <div class="price">
                    <h4>Rp {{ floatval($product->product->stocks[0]->price) }} ,-</h4>
                </div>
            </div>
        </a>
    @endforeach
@endsection