<div class="container-xl d-none d-md-block pt-2">
    <div class="row align-items-center">
        <div class="col text-start">
            <a class="nav-link" href="/">Lets Shopping Now</a>
        </div>
        <div class="col text-end">
            <form action="/seller/logout" method="POST">
                {{-- <a class="btn text-white" href="#">+62-868-726-381</a> |  --}}
                <a class="btn text-white" href="/service">Call Center</a> | @csrf<button class="btn text-white" >Logout</button>
            </form>
        </div>
    </div>
</div>  
<nav class="navbar navbar-expand-md bg-body-tertiary">
    <div class="container-xl">
        <li class="nav-item active d-md-none" style="list-style: none">
            @if (URL::previous())
                <a class="nav-link" href="{{ URL::previous() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    @yield('title')
                </a>
            @else
                <a class="nav-link" href="#">@yield('title')</a>
            @endif
        </li>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-none d-md-block">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('seller.dashboard.index', [
                                'category' => strtolower($category->slug)
                            ]) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <ul class="navbar-nav d-md-none">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Lets Shopping Now</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($categories as $category)
                            <a class="dropdown-item" href="{{ route('seller.dashboard.index', [
                                'category' => strtolower($category->slug)
                            ]) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/service">Call Center</a>
                </li>
                <li class="nav-item">
                    <form action="/seller/logout" method="POST">
                        @csrf
                        <button class="nav-link btn btn-link mb-3 text-white" style="padding-left: 0px;">Logout</button>
                    </form>
                </li>
            </ul>
            <div class="search-and-icons w-100">
                <form action="{{ route('seller.home') }}" class="d-flex mb-2" role="search">
                    @csrf
                    <input class="form-control me-2" name="search" type="search" aria-label="Search" value="{{ old('search', request()->search) }}">
                </form>
            </div>
        </div>
    </div>
    @if (trim($__env->yieldContent('title')) === 'Wallet')
        <div class="container-xl d-md-none">
            <div class="row mt-4">
                <div class="col">
                    <span class="h6 font-semibold text-sm d-block mb-3">Balance ($)</span>
                    <span class="h3 font-bold mb-0"> {{ number_format(auth()->user()->balance, 2) }}</span>
                </div>
            </div>
        </div>
    @endif
</nav>