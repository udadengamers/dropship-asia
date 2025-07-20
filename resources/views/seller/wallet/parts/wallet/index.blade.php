@if ($wallets->count() > 0)
    <div id="itemLoad">
        @include('seller.wallet.parts.wallet.history')
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