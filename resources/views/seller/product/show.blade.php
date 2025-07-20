<x-seller.auth-layout>
    @section('title', 'Product Details')
    <style>
        
    	ul{
			list-style: none outside none;
		    padding-left: 0;
            margin: 0;
		}
        .demo .item{
            margin-bottom: 60px;
        }
		.content-slider li{
		    background-color: #ed3020;
		    text-align: center;
		    color: #FFF;
		}
		.content-slider h3 {
		    margin: 0;
		    padding: 70px 0;
		}
		.demo{
			width: 800px;
		}
        .text-bold {
            font-weight: 800;
        }

        text-color {
            color: #0093c4;
        }

        /* Main image - left */
        .main-img img {
            width: 100%;
        }

        /* Preview images */
        .previews img {
            width: 100%;
            height: 140px;
        }

        .main-description .category {
            text-transform: uppercase;
            color: #0093c4;
        }

        .main-description .product-title {
            font-size: 2.5rem;
        }

        .old-price-discount {
            font-weight: 600;
        }

        .new-price {
            font-size: 2rem;
        }

        .details-title {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 1.2rem;
            color: #757575;
        }

        .buttons .block {
            margin-right: 5px;
        }

        .quantity input {
            border-radius: 0;
            height: 40px;

        }


        .custom-btn {
            text-transform: capitalize;
            background-color: #0093c4;
            color: white;
            width: 150px;
            height: 40px;
            border-radius: 0;
        }

        .custom-btn:hover {
            background-color: #0093c4 !important;
            font-size: 18px;
            color: white !important;
        }

        .similar-product img {
            height: 400px;
        }

        .similar-product {
            text-align: left;
        }

        .similar-product .title {
            margin: 17px 0px 4px 0px;
        }

        .similar-product .price {
            font-weight: bold;
        }

        .questions .icon i {
            font-size: 2rem;
        }

        .questions-icon {
            font-size: 2rem;
            color: #0093c4;
        }

        .product-details img {
            max-width: 100%;
            height: auto;
        }


        /* Small devices (landscape phones, less than 768px) */
        @media (max-width: 767.98px) {

            /* Make preview images responsive  */
            .previews img {
                width: 100%;
                height: auto;
            }

        }
        .img-slider {
            width: 100%;
            min-height: 250px;
            max-height: 400px;
            border-radius: 0px;
            -o-object-fit: cover;
            object-fit: cover;
        }
        .lSSlideOuter .lSPager.lSGallery img {
            width: 100%;
            min-height: 90px;
            max-height: 90px;
            border-radius: 0px;
            -o-object-fit: cover;
            object-fit: cover;
        }
    </style>
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="container my-5">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="item">            
                                    <div class="clearfix" style="max-width:474px;">
                                        <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                            @foreach ($product->product_images as $image)
                                                <li data-thumb="{{ url('storage/' . $image->path_file) }}"> 
                                                    <img class="img-slider img-fluid" src="{{ url('storage/' . $image->path_file) }}" />
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 mt-3">
                                <div class="main-description px-2">
                                    <div class="category text-bold">
                                        Category: <a href="{{ route('seller.dashboard.index', [
                                            'category' => strtolower($product->category->name)
                                        ]) }}">{{ $product->category->slug }}</a>
                                    </div>
                                    <div class="product-title text-bold my-3">
                                        {{ $product->name }}
                                    </div>
                                    <div class="price-area my-4">
                                        <p class="new-price text-bold mb-1">$ {{ $product->stocks()->first()->price }}</p>
                                    </div>
                                </div>

                                <div class="product-details my-4">
                                    <p class="details-title text-color mb-1">Stock</p>
                                    <p class="description">
                                        {{ $product->total_stocks }}
                                    </p>
                                </div>

                                <div class="product-details my-4">
                                    <p class="details-title text-color mb-1">Variant</p>
                                    <p class="description">
                                        @foreach ($product->stocks as $stock)
                                            <button class="form-check-label btn btn-outline-danger">
                                                {{ $stock->name }}
                                            </button>
                                        @endforeach
                                    </p>
                                </div>

                                <div class="product-details my-4">
                                    <p class="details-title text-color mb-1">Product Details</p>
                                    <p class="description">
                                        {!! $product->description !!}
                                    </p>
                                </div>
                                <div class="buttons d-flex my-5">
                                    <div class="block">
                                        <form action="{{ route('seller.product.update', $product->uuid) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <button type="submit" class="w-100 btn btn-default bold-btn">Add to Shop</button>
                                        </form>
                                    </div>
                                    <div class="block">
                                        {{-- <form action="{{ route('seller.product.destroy', $product->uuid) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="w-100 btn btn-default bold-btn">Remove From Shop</button>
                                        </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup-modal" tabindex="-1" aria-labelledby="popup-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <img src="" class="img-fluid" id="popup-large-image">
        </div>
    </div>
    @push('after-scripts')
        <script>
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:9,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }
            });
            $('.img-slider').click(function() {
                $("#popup-large-image").attr('src', $(this).attr('src'));
                $("#popup-modal").modal('show');
            });
        </script>
    @endpush
</x-seller.auth-layout>
