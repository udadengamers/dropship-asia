@forelse ($wallets as $wallet)
    <details>
        <summary>
            <div>
                <span>
                    {!! $wallet->model[$wallet->detailable_type]['icon'] !!}
                </span>
                <h3>
                    <strong>{{ $wallet->model[$wallet->detailable_type]['name'] }}</strong>
                    <small>{{ $wallet->description }}</small>
                </h3>
                <span>{!! $wallet->amount_in != 0 ? '<div class="text-success"> + $' . number_format($wallet->amount_in, 2) . '</div>' : '<div class="text-danger"> - $' . number_format($wallet->amount_out, 2) . '</div>' !!}</span>
            </div>
        </summary>
        <div>
            <dl>
                <div>
                    <dt>Time</dt>
                    <dd>{{ $wallet->created_at->format('D d-m-y H:i') }}</dd>
                </div>
                <div>
                    <dt>Reference ID</dt>
                    <dd>{{ $wallet->detail?->trx_code ?? (str_contains(strtolower($wallet->detailable_type) , 'bonus') ? $wallet->detail?->order?->trx_code : '-') }}</dd>
                </div>
            </dl>
        </div>
    </details>
@empty
    No Transaction in your history yet.
@endforelse