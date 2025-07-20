<div id="shop">
    <nav class="navbar navbar-expand navbar-light bg-white">
        <div style="overflow-x: auto">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0 ">
                <li class="nav-item" role="presentation" style="padding-left: 12px;">
                    <a href="{{ route('seller.withdrawl-record') }}" class="nav-link {{ in_array(request()->get('tab'),['']) ? 'active' : '' }}" role="button" aria-pressed="true">All</a>
                </li>
                <li class=" nav-item" role="presentation" style="padding-left: 12px;">
                    <a href="{{ route('seller.withdrawl-record', ['tab' => 'approved']) }}" class="nav-link {{ request()->get('tab') == 'approved' ? 'active' : '' }}" role="button" aria-pressed="true">Examination Passed</a>
                </li>
                <li class=" nav-item" role="presentation" style="padding-left: 12px;">
                    <a href="{{ route('seller.withdrawl-record', ['tab' => 'in_review']) }}" class="nav-link {{ request()->get('tab') == 'in_review' ? 'active' : '' }}" role="button" aria-pressed="true">Under Review</a>
                </li>
                <li class="nav-item" role="presentation" style="padding-left: 12px;">
                    <a href="{{ route('seller.withdrawl-record', ['tab' => 'rejected']) }}" class="nav-link {{ request()->get('tab') == 'rejected' ? 'active' : '' }}" role="button" aria-pressed="true">Rejected</a>
                </li>
                <li class="nav-item" role="presentation" style="padding-left: 12px;">
                    <a href="{{ route('seller.withdrawl-record', ['tab' => 'fail']) }}" class="nav-link {{ request()->get('tab') == 'fail' ? 'active' : '' }}" role="button" aria-pressed="true">Fail</a>
                </li>
            </ul>
        </div>
    </nav>
</div>

@if ($withdraws->count() > 0)
    <div id="itemLoad">
        @include('seller.wallet.parts.withdraw.history')
    </div>
@else
    <div class="p-3">
        No Transaction in your history yet.
    </div>
@endif

<div class="ajax-load mt-3 p-3" style="display:none; text-align:center;">
    <p>
        <img class="img-fluid" src="/img/spin.gif" width="50">
    </p>
</div>