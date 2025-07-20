<x-seller.auth-layout>

    {{-- title --}}
    @section('title', 'Shop')

    {{-- style --}}
    <style>

        .read-more {
            position: absolute;
            bottom: 190px;
            right: 15px;
            padding-left: 8px;
            padding-right: 8px;
        }
        #shop .navbar .navbar-nav .nav-link {
            color: rgb(52, 52, 52) !important;
        }

        #shop li {
            white-space: nowrap;
        }

        #shop ul {
            padding-bottom: 5px;
        }

        #shop .navbar .nav-link.active {
            display: inline-block;
            position: relative;
            background: none;
            color: #f53d2d;
        }

        #shop .navbar .nav-link.active::after {
            content: "";
            display: block;
            width: 100%;
            border-bottom: 3px solid #f53d2d;
            position: absolute;
            left: 0;
            bottom: -0.2em;
        }
    </style>

    {{-- header shop --}}
    <div class="card text-start mb-3">
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 text-center">
                    <img src="{{ request()->shop->profile_picture ? url('storage/'.request()->shop->profile_picture) : 'https://via.placeholder.com/150' }}" alt="Profile Picture" class="img-fluid w-100 rounded-circle">
                    <a href="{{ route('seller.shop.edit', request()->shop->uuid) }}" class="btn btn-outline-danger d-block d-sm-none read-more">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-gear" viewBox="0 0 16 16">
                            <path
                                d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                            <path
                                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                        </svg>
                    </a>
                </div>
                <div class="col">
                    <h4 class="card-title">{{ request()->shop->name }}</h4>
                    <p class="card-text">{{ request()->shop->description }}</p>
                </div>
                <div class="col-md-2 col-sm-12 text-end d-flex align-items-center justify-content-end d-none d-sm-block">
                    <a href="{{ route('seller.shop.edit', request()->shop->uuid) }}" class="btn btn-outline-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-gear" viewBox="0 0 16 16">
                            <path
                                d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                            <path
                                d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- banner --}}
    <div class="card text-start mb-3">
        <img class="img-fluid w-100" style="
        object-fit: cover;
        height: 300px;"
        src="https://static.wixstatic.com/media/430602_e15d2da61d534c2fa54ab7627fcd1265~mv2.jpg" alt="Title">
        <div class="card-body">
            <p class="card-text">{!! request()->shop->description !!}</p>
            <p class="card-text"><a
                    href="{{ url('/shop/' . request()->shop->slug) }}">{{ url('/shop/' . request()->shop->slug) }}</a>
            </p>
        </div>
    </div>

    {{-- body best products --}}
    <div class="card text-start mb-3">
        <div class="card-body">
            <h4 class="card-title">Best Selling Prodcut</h4>
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                @forelse ($best_products as $item)
                    @php $product = $item->product; @endphp
                    @if ($product)
                        <div class="col hp product">
                            <div class="card h-100 shadow-sm">
                                <a href="{{ route('seller.product.show', $product->uuid) }}">
                                    <img src="{{ url('storage/' . $product->product_images->first()->path_file) }}"
                                        class="card-img-top" alt="product.title" />
                                </a>
                                <div class="card-body">
                                    <div class="clearfix">
                                        <span class="float-start"><b>$
                                                {{ number_format($product->stocks->first()->price) }}</b></span>

                                        <span class="float-end">
                                            <a href="#"
                                                class="small text-muted text-uppercase aff-link">Previews</a>
                                        </span>
                                    </div>
                                    <h5 class="card-title">
                                        <a target="_blank" href="#">
                                            <b>{{ $product->name }}</b>
                                        </a>
                                        <br>
                                        {{-- <span>
                                            {{ $product->description }}
                                        </span> --}}
                                    </h5>

                                    {{-- <div class="d-grid gap-2 my-4"> --}}

                                        {{-- <form action="{{ route('seller.product.update', $product->uuid) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="w-100 btn btn-default bold-btn">Add to
                                            Shop</button>
                                    </form> --}}

                                    {{-- </div> --}}
                                </div>
                            </div>
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
    </div>

    {{-- header status --}}
    <div class="row mb-3">
        <div class="col" id="shop">
            <nav class="navbar navbar-expand-sm navbar-light bg-white"
                id="product-list-shop-{{ request()->shop->uuid }}">
                <div class="container">
                    <a href="{{ route('seller.shop.index', ['#product-list-shop-' . request()->shop->uuid]) }}"
                        class="d-block d-sm-none nav-link" role="button"
                        aria-pressed="true">{{ in_array(request()->get('tab'), ['']) ? 'Active' : ucwords(str_replace('_', ' ', request()->get('tab'))) }}</a>
                    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path
                                d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                        </svg>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId" style="overflow-x: auto">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0 ">
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.shop.index', ['#product-list-shop-' . request()->shop->uuid]) }}"
                                    class="nav-link {{ in_array(request()->get('tab'), ['']) ? 'active' : '' }}"
                                    role="button" aria-pressed="true">Active</a>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.shop.index', ['tab' => 'removed', '#product-list-shop-' . request()->shop->uuid]) }}"
                                    class="nav-link {{ request()->get('tab') == 'removed' ? 'active' : '' }}"
                                    role="button" aria-pressed="true">Removed</a>
                            </li> --}}
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.shop.index', ['tab' => 'out_of_stock', '#product-list-shop-' . request()->shop->uuid]) }}"
                                    class="nav-link {{ request()->get('tab') == 'out_of_stock' ? 'active' : '' }}"
                                    role="button" aria-pressed="true">Out Of Stock</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    {{-- body --}}
    @if ($product_shops->count() > 0)
        <div class="row g-3" id="itemLoad">
            @include('seller.shop.parts.item')
        </div>
    @else
        @include('seller.page.no_result')
    @endif

    <div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
        <p>
            <img class="img-fluid" src="/img/spin.gif" width="50">
        </p>
    </div>
    
    @push('after-scripts')
        <script>
            $(document).ready(function(){
                chage_class(innerWidth);
            });
            $(window).resize((event) => {
                chage_class(innerWidth);
            });

            function chage_class(innerWidth) {
                if (innerWidth <= 335) {
                    $('.mobile-col').attr('class', function(index, attr) {
                        //Return the updated string, being sure to only replace z- at the start of a class name.
                        return attr.replace(/(^|\s)col-6/g, 'col');
                    });
                }
            }
        </script>
    @endpush
</x-seller.auth-layout>
