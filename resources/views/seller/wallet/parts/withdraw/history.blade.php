@foreach ($withdraws as $withdraw)
    <details>
        <summary>
            <div style="align-items: flex-start!important;">
                <h3>
                    <strong>{!! $withdraw->amount_submitted != 0 ? '<div class="text-success"> + ' . format_number($withdraw->amount_submitted, 1) . ' USDT</div>' : '<div class="text-danger"> - ' . format_number($withdraw->amount_submitted, 1) . ' USDT</div>' !!}</strong> 
                    {{-- <strong>{{ $withdraw->id }}</strong> --}}
                    <small class="mt-2" style="font-size: 12px">USDT Withdraw</small>
                </h3>
                <span style="font-weight:500;">
                    <small style="font-size: 12px">
                        {!! $withdraw->state == 'approved' ? '<div class="text-success">' . $withdraw->states[$withdraw->state] . '</div>' : '<div class="text-muted"> ' . $withdraw->states[$withdraw->state] . '</div>' !!}
                    </small>
                </span>
            </div>
            <div class="text-end justify-content-end">
                <small class="justify-" style="font-size: 12px; margin-top: -30px;">
                    {{ $withdraw->created_at->format('Y-m-d H:i:s') }}
                </small>
            </div>
        </summary>
    </details>
@endforeach