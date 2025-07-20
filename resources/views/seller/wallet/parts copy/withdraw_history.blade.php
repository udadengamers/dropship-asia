@forelse ($withdraws as $withdraw)
    <details>
        <summary>
            <div>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="withdraw"><path d="M22,2H2A1,1,0,0,0,1,3v8a1,1,0,0,0,1,1H5v9a1,1,0,0,0,1,1H18a1,1,0,0,0,1-1V12h3a1,1,0,0,0,1-1V3A1,1,0,0,0,22,2ZM7,20V18a2,2,0,0,1,2,2Zm10,0H15a2,2,0,0,1,2-2Zm0-4a4,4,0,0,0-4,4H11a4,4,0,0,0-4-4V8H17Zm4-6H19V7a1,1,0,0,0-1-1H6A1,1,0,0,0,5,7v3H3V4H21Zm-9,5a3,3,0,1,0-3-3A3,3,0,0,0,12,15Zm0-4a1,1,0,1,1-1,1A1,1,0,0,1,12,11Z"></path></svg>
                </span>
                <h3>
                    <strong>Withdraw</strong>
                    <small>{{ $withdraw->state == 'approved' ? 'Withdraw has been approved by admin' : 'Withdraw has been rejected by admin' }}</small>
                </h3>
                <span>$ {{ number_format(($withdraw->state == 'approved' ? $withdraw->amount_approved : 0), 2) }}</span>
            </div>
        </summary>
        <div>
            <dl>
                <div>
                    <dt>Time</dt>
                    <dd>{{ $withdraw->created_at->format('D d-m-y H:i') }}</dd>
                </div>
                <div>
                    <dt>Reference ID</dt>
                    <dd>{{ $withdraw->trx_code ?? '-' }}</dd>
                </div>
            </dl>
        </div>
    </details>
@empty
    No Transaction in your history yet.
@endforelse