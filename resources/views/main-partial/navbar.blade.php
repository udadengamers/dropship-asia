<div class="navbar-container">
    <div class="mid-nav">
        <div class="badge-nav">
            <a href="/"><h1>Dropship</h1></a>
            <a href="/"><img src={{ asset("/img/1656181355shopee-icon-white.png") }} alt=""></a>
        </div>
        <div class="search-nav">
            <form action="/" class="search-container">
                <input class="box-search" type="text" name="search" placeholder="what product are you looking today..." value="{{ request('search') }}">
                <button class="button-search" type="submit"><i class="fas fa-search"></i></button>
            </form>

        </div>
        <div class="right-info-nav">
            <ul class="nav-info">
                <li class="nav-menu">
                    <div class="dropdown">
                        <button class="dropbtn" style="font-size:20px;"><i class="far fa-question-circle "></i></button>
                        <div class="dropdown-content">
                          <a href="/my-transaction">Transaction</a>
                          <a href="{{ route('seller.login') }}">Seller Area</a>
                          {{-- <a href="#">Help</a>
                          <a href="#">About</a> --}}
                        </div>
                    </div>                
                </li>
            </ul>
        </div>
    </div>
</div>