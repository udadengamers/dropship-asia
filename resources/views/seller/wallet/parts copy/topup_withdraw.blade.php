<div class="col-xl-6 col-12">
    <a href="{{ route('seller.withdraw.index') }}" class="nav-link">
        <div class="card border-1 shadow-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Withdraw</span>
                        <span class="h3 font-bold mb-0">$ {{ number_format(auth()->user()->withdraw, 2) }}</span>
                    </div>
                    <div class="col-auto text-center d-flex align-items-center">
                        <div class="icon icon-shape bg-tertiary d-none d-md-none d-xl-block text-lg rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                        </div>
                        <div class="icon icon-shape bg-tertiary d-xl-none text-lg rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                {{-- <div class="mt-2 mb-0 text-sm">
                    <span class="badge badge-pill bg-soft-success text-success me-2">
                        <i class="bi bi-arrow-up me-1"></i>13%
                    </span>
                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                </div> --}}
            </div>
        </div>
    </a>
</div>
<div class="col-xl-6 col-12">
    <a href="{{ route('seller.topup.index') }}" class="nav-link">
        <div class="card border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Topup</span>
                        <span class="h3 font-bold mb-0">$ {{ number_format(auth()->user()->topup, 2) }}</span>
                    </div>
                    <div class="col-auto text-center d-flex align-items-center">
                        <div class="icon icon-shape bg-tertiary d-none d-md-none d-xl-block text-lg rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                            </svg>
                        </div>
                        <div class="icon icon-shape bg-tertiary d-xl-none text-lg rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                {{-- <div class="mt-2 mb-0 text-sm">
                    <span class="badge badge-pill bg-soft-success text-success me-2">
                        <i class="bi bi-arrow-up me-1"></i>13%
                    </span>
                    <span class="text-nowrap text-xs text-muted">Since last month</span>
                </div> --}}
            </div>
        </div>
    </a>
</div>