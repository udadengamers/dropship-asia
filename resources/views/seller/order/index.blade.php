<x-seller.auth-layout>

    {{-- title --}}
    @section('title', 'Order')

    {{-- style --}}
    <style>
        #shop .navbar .navbar-nav .nav-link {
            color: rgb(52, 52, 52)!important;
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

    {{-- form search --}}
    <form action="{{ route('seller.order.index') }}" class="d-flex mb-3 me-3" role="search">
        <input class="form-control me-2" name="order_search" type="search" aria-label="Search" value="{{ old('order_search', request()->order_search) }}">
        <button class="btn" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </form>

    {{-- header status --}}
    <div class="row mb-3">
        <div class="col" id="shop">
            <nav class="navbar navbar-expand-sm navbar-light bg-white">
                <div class="container">
                    <a href="{{ route('seller.order.index') }}" class="d-block d-sm-none nav-link" role="button" aria-pressed="true">{{ in_array(request()->get('tab'),['']) ? 'All' : (ucwords(str_replace('_', ' ', request()->get('tab')))) }}</a>
                    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
                            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
                        </svg>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavId" style="overflow-x: auto">
                        <ul class="navbar-nav me-auto mt-2 mt-lg-0 ">
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.order.index') }}" class="nav-link {{ in_array(request()->get('tab'),['']) ? 'active' : '' }}" role="button" aria-pressed="true">All</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.order.index', ['tab' => 'pending_payment']) }}" class="nav-link {{ request()->get('tab') == 'pending_payment' ? 'active' : '' }}" role="button" aria-pressed="true">Pending Payment</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.order.index', ['tab' => 'payment_submitted']) }}" class="nav-link {{ request()->get('tab') == 'payment_submitted' ? 'active' : '' }}" role="button" aria-pressed="true">Submitted Payment</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.order.index', ['tab' => 'approved_payment']) }}" class="nav-link {{ request()->get('tab') == 'approved_payment' ? 'active' : '' }}" role="button" aria-pressed="true">Approved Payment</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.order.index', ['tab' => 'seller_response']) }}" class="nav-link {{ request()->get('tab') == 'seller_response' ? 'active' : '' }}" role="button" aria-pressed="true">Seller Response</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.order.index', ['tab' => 'shipped']) }}" class="nav-link {{ request()->get('tab') == 'shipped' ? 'active' : '' }}" role="button" aria-pressed="true">Shipped</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.order.index', ['tab' => 'cancelled']) }}" class="nav-link {{ request()->get('tab') == 'cancelled' ? 'active' : '' }}" role="button" aria-pressed="true">Cancelled</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="{{ route('seller.order.index', ['tab' => 'received']) }}" class="nav-link {{ request()->get('tab') == 'received' ? 'active' : '' }}" role="button" aria-pressed="true">Received</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    {{-- header search --}}
    @if (request()->get('order_search'))
        @include('seller.page.search', [
            'keyword' => request()->order_search,
            'data' => $orders,
        ])
    @endif

    {{-- body --}}
    @if ($orders->count() > 0)
        <div id="itemLoad">
            @include('seller.order.parts.item')
        </div>
    @else
        @include('seller.page.no_result')
    @endif

    <div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
        <p>
            <img class="img-fluid" src="/img/spin.gif" width="50">
        </p>
    </div>
    
    {{-- script --}}
    @push('after-scripts')

    @endpush
</x-seller.auth-layout>
