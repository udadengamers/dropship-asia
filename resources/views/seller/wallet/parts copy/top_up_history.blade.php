@forelse ($topups as $topup)
    <details>
        <summary>
            <div>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="top-up-balance"><path d="M22 4v1H5a1 1 0 0 0 0 2h16a1 1 0 0 1 1 1v11a2 2 0 0 1-2 2h-7v-6.586l1.293 1.293a1 1 0 0 0 1.414-1.414l-3-3a1 1 0 0 0-1.416 0l-3 3a1 1 0 0 0 1.414 1.414L11 14.414V21H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h17a1 1 0 0 1 1 1Z"></path></svg>
                </span>
                <h3>
                    <strong>Topup</strong>
                    <small>{{ $topup->state == 'approved' ? 'Topup has been approved by admin' : 'Topup has been rejected by admin' }}</small>
                </h3>
                <span>$ {{ number_format(($topup->state == 'approved' ? $topup->amount_submitted : 0), 2) }}</span>
            </div>
        </summary>
        <div>
            <dl>
                <div>
                    <dt>Time</dt>
                    <dd>{{ $topup->created_at->format('D d-m-y H:i') }}</dd>
                </div>
                <div>
                    <dt>Reference ID</dt>
                    <dd>{{ $topup->trx_code ?? '-' }}</dd>
                </div>
            </dl>
        </div>
    </details>
@empty
    No Transaction in your history yet.
@endforelse