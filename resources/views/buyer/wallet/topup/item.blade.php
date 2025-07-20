
@foreach ($records as $record)
    <details>
        <summary>
            <div style="align-items: flex-start!important;">
                <h3>
                    <strong>{!! $record->amount_submitted != 0 ? '<div class="text-success"> + ' . number_format($record->amount_submitted, 1) . ' USDT</div>' : '<div class="text-danger"> - ' . number_format($record->amount_submitted, 1) . ' USDT</div>' !!}</strong> 
                    <small class="mt-2" style="font-size: 12px">USDT Topup</small>
                </h3>
                <span style="font-weight:500;">
                    <small style="font-size: 12px">
                        {!! $record->state == 'approved' ? '<div class="text-success">' . $record->states[$record->state] . '</div>' : '<div class="text-muted"> ' . $record->states[$record->state] . '</div>' !!}
                    </small>
                </span>
            </div>
            <div class="text-end justify-content-end">
                <small class="justify-" style="font-size: 12px; margin-top: -30px;">
                    {{ $record->created_at->format('Y-m-d H:i:s') }}
                </small>
            </div>
        </summary>
    </details>
@endforeach