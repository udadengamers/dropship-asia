@foreach ($topups as $topup)
    <details>
        <summary>
            <div style="align-items: flex-start!important;">
                <h3>
                    <strong>{!! $topup->amount_submitted != 0 ? '<div class="text-success"> + ' . format_number($topup->amount_submitted, 1) . ' USDT</div>' : '<div class="text-danger"> - ' . format_number($topup->amount_submitted, 1) . ' USDT</div>' !!}</strong> 
                    <small class="mt-2" style="font-size: 12px">USDT Topup</small>
                </h3>
                <span style="font-weight:500;">
                    <small style="font-size: 12px">
                        {!! $topup->state == 'approved' ? '<div class="text-success">' . $topup->states[$topup->state] . '</div>' : '<div class="text-muted"> ' . $topup->states[$topup->state] . '</div>' !!}
                    </small>
                </span>
            </div>
            <div class="text-end justify-content-end">
                <small class="justify-" style="font-size: 12px; margin-top: -30px;">
                    {{ $topup->created_at->format('Y-m-d H:i:s') }}
                </small>
            </div>
        </summary>
    </details>
@endforeach