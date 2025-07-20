<div class="col">
    <section>
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
                                    <a href="{{ route('seller.wallet.index') }}" class="nav-link {{ in_array(request()->get('tab'),['']) ? 'active' : '' }}" role="button" aria-pressed="true">Wallet</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="{{ route('seller.wallet.index', ['tab' => 'withdraw']) }}" class="nav-link {{ request()->get('tab') == 'withdraw' ? 'active' : '' }}" role="button" aria-pressed="true">Withdraw</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="{{ route('seller.wallet.index', ['tab' => 'topup']) }}" class="nav-link {{ request()->get('tab') == 'topup' ? 'active' : '' }}" role="button" aria-pressed="true">Topup</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        
        @if (in_array(request()->get('tab'),['topup']))
            @include('seller.wallet.parts.top_up_history')
        @elseif (in_array(request()->get('tab'),['withdraw']))
            @include('seller.wallet.parts.withdraw_history')
        @else
            @include('seller.wallet.parts.wallet_history')
        @endif
    </section>
</div>