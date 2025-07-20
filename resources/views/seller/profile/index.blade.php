<x-seller.auth-layout>
    <style>
        #carouselHero .carousel-item img {
            object-fit: cover;
            object-position: center;
            overflow: hidden;
            height: 40vh;
        }
        .read-more {
            position: absolute;
            bottom: 190px;
            right: 15px;
            padding-left: 8px;
            padding-right: 8px;
        }
    </style>
    @section('title', 'Profile')

    <div class="card text-start mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 text-center">
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="img-fluid rounded-circle">
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

    <div class="card text-start mb-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h4 class="card-title">Wallet</h4>
                </div>
                <div class="col text-end">
                    <a class="nav-link" href="{{ route('seller.wallet.index') }}">
                        Wallet
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.7em" height="0.7em" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <div class="shadow-none p-3 bg-light rounded text-center">
                        <h1>$ {{ number_format(auth()->user()->balance, 2) }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card text-start mb-3">
        <div class="card-body">
            <h4 class="card-title mb-3">Orders Announcement</h4>

            <div id="carouselHero" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselHero" class="active" aria-current="true"
                        data-bs-slide-to="0" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselHero" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://img.freepik.com/premium-vector/great-discount-final-sale-up-percent-off-banner_419341-1810.jpg" class="d-block w-100"
                            alt="Image Description">
                    </div>
                    <div class="carousel-item">
                        <img src="https://img.freepik.com/premium-vector/super-sale-special-offer-announcement-banner-template_419341-573.jpg" class="d-block w-100" alt="POW Logo">
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselHero"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card text-start mb-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h4 class="card-title">Orders Status</h4>
                </div>
                <div class="col text-end">
                    <a class="nav-link" href="{{ route('seller.order.index') }}">
                        Order History
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.7em" height="0.7em" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-12 mb-3">
                    <div class="shadow-none p-3 bg-light rounded text-center">
                        <h1>{{ auth()->user()->shop->orders()->where('state', 'created')->count() }}</h1>
                        <p>
                            Payment Pending
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                    <div class="shadow-none p-3 bg-light rounded text-center">
                        <h1>{{ auth()->user()->shop->orders()->where('state', 'approved')->count() }}</h1>
                        <p>
                            Payment Approved
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                    <div class="shadow-none p-3 bg-light rounded text-center">
                        <h1>{{ auth()->user()->shop->orders()->where('state', 'shipping')->count() }}</h1>
                        <p>
                            Shipping
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 mb-3">
                    <div class="shadow-none p-3 bg-light rounded text-center">
                        <h1>{{ auth()->user()->shop->orders()->where('state', 'received')->count() }}</h1>
                        <p>
                            Received
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card text-start mb-3">
        <div class="card-body">
            <h4 class="card-title">Menu</h4>
            <div class="row mt-3">
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <div class="shadow-none rounded text-center">
                        <a href="{{ route('seller.dashboard.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#111" class="bi bi-globe-asia-australia" viewBox="0 0 16 16">
                                <path d="m10.495 6.92 1.278-.619a.483.483 0 0 0 .126-.782c-.252-.244-.682-.139-.932.107-.23.226-.513.373-.816.53l-.102.054c-.338.178-.264.626.1.736a.476.476 0 0 0 .346-.027ZM7.741 9.808V9.78a.413.413 0 1 1 .783.183l-.22.443a.602.602 0 0 1-.12.167l-.193.185a.36.36 0 1 1-.5-.516l.112-.108a.453.453 0 0 0 .138-.326ZM5.672 12.5l.482.233A.386.386 0 1 0 6.32 12h-.416a.702.702 0 0 1-.419-.139l-.277-.206a.302.302 0 1 0-.298.52l.761.325Z"/>
                                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM1.612 10.867l.756-1.288a1 1 0 0 1 1.545-.225l1.074 1.005a.986.986 0 0 0 1.36-.011l.038-.037a.882.882 0 0 0 .26-.755c-.075-.548.37-1.033.92-1.099.728-.086 1.587-.324 1.728-.957.086-.386-.114-.83-.361-1.2-.207-.312 0-.8.374-.8.123 0 .24-.055.318-.15l.393-.474c.196-.237.491-.368.797-.403.554-.064 1.407-.277 1.583-.973.098-.391-.192-.634-.484-.88-.254-.212-.51-.426-.515-.741a6.998 6.998 0 0 1 3.425 7.692 1.015 1.015 0 0 0-.087-.063l-.316-.204a1 1 0 0 0-.977-.06l-.169.082a1 1 0 0 1-.741.051l-1.021-.329A1 1 0 0 0 11.205 9h-.165a1 1 0 0 0-.945.674l-.172.499a1 1 0 0 1-.404.514l-.802.518a1 1 0 0 0-.458.84v.455a1 1 0 0 0 1 1h.257a1 1 0 0 1 .542.16l.762.49a.998.998 0 0 0 .283.126 7.001 7.001 0 0 1-9.49-3.409Z"/>
                            </svg>
                        </a>
                        <p class="mt-3">
                            Wholesale
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <div class="shadow-none rounded text-center">
                        <a href="{{ route('seller.order.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#111" class="bi bi-file-text" viewBox="0 0 16 16">
                                <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                            </svg>
                        </a>
                        <p class="mt-3">
                            Order
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <div class="shadow-none rounded text-center">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#111" class="bi bi-shield-lock" viewBox="0 0 16 16">
                                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"/>
                            </svg>
                        </a>
                        <p class="mt-3">
                            Change Password
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <div class="shadow-none rounded text-center">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#111" class="bi bi-chat" viewBox="0 0 16 16">
                                <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                            </svg>
                        </a>
                        <p class="mt-3">
                            Chat
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-6 mb-3">
                    <div class="shadow-none rounded text-center">
                        <form action="/seller/logout" method="POST">
                            @csrf
                            <button class="btn" style="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#111" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                </svg>
                            </button>
                            <p class="mt-3">
                                Sign Out
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-seller.auth-layout>