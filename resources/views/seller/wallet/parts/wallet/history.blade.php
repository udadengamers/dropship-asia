@foreach ($wallets as $wallet)
    <details>
        <summary>
            <div>
                <h3>
                    <strong>{!! $wallet->amount_in != 0 ? '<div class="text-success"> + ' . format_number($wallet->amount_in, 1) . ' USDT</div>' : '<div class="text-danger"> - ' . format_number($wallet->amount_out, 1) . ' USDT</div>' !!}</strong> 
                    <small class="mt-2" style="font-size: 12px">{{ $wallet->override_description }}</small>
                </h3>
                <span style="font-weight:500;"><small class="mt-2" style="font-size: 12px">{{ $wallet->created_at->format('Y-m-d H:i:s') }}</small></span>
            </div>
        </summary>
    </details>
@endforeach