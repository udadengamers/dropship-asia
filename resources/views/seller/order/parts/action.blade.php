@php
    $buttons = $order->button_actions();
@endphp

<div class="row">
    <div class="col mx-auto"></div>
    <div class="col-lg-2 my-3">
        <a class="btn btn-primary-default w-100" data-bs-toggle="modal" 
        data-bs-target="#exampleSupplierShip{{ $order->uuid }}">Supplier Ship</a>
    </div>
    <div class="col-lg-2 my-3">
        <a class="btn btn-primary-default w-100" data-bs-toggle="modal"
            data-bs-target="#exampleViewPayment{{ $order->uuid }}">View Payment</a>
    </div>
    <div class="col-lg-2 my-3">
        <a class="btn btn-success w-100" data-bs-toggle="modal"
            data-bs-target="#exampleContactCustomer{{ $order->uuid }}">Contact Customer</a>
    </div>
    <div class="col-lg-2 my-3">
        <a class="btn btn-primary-default w-100" data-bs-toggle="modal"
            data-bs-target="#exampleViewLogistics{{ $order->uuid }}">View Logistics</a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleViewLogistics{{ $order->uuid }}" tabindex="-1" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <section class="root">
                        <figure>
                            <div class="row">
                                <div class="col text-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                    </svg>
                                </div>
                                <div class="col text-end">
                                    <figcaption>
                                        <h4>Tracking Details</h4>
                                        <h6>Shipping Number</h6>
                                        <h2>{{ $order->shipping_number ? $order->shipping_number : '-' }}</h2>
                                    </figcaption>
                                </div>
                            </div>
                        </figure>
                        <div class="order-track">
                            <div class="order-track-step">
                                <div class="order-track-status">
                                    <span class="order-track-status-dot"></span>
                                    <span class="order-track-status-line"></span>
                                </div>
                                <div class="order-track-text">
                                    <p class="order-track-text-stat">Order Created</p>
                                    <span class="order-track-text-sub">Processing Order</span>
                                </div>
                            </div>
                            <div class="order-track-step">
                                <div class="order-track-status">
                                    <span class="order-track-status-dot"></span>
                                    <span class="order-track-status-line"></span>
                                </div>
                                <div class="order-track-text">
                                    <p class="order-track-text-stat">Shipped - 已发货 - 中国广州市启动街 123 号</p>
                                    <span class="order-track-text-sub">shipping</span>
                                </div>
                            </div>
                            <div class="order-track-step">
                                <div class="order-track-status">
                                    <span class="order-track-status-dot"></span>
                                    <span class="order-track-status-line"></span>
                                </div>
                                <div class="order-track-text">
                                    <p class="order-track-text-stat">Estimated - 预计 - 456 End St. 广州, 中国</p>
                                    <span class="order-track-text-sub">shipping</span>
                                </div>
                            </div>
                            <div class="order-track-step">
                                <div class="order-track-status">
                                    <span class="order-track-status-dot"></span>
                                </div>
                                <div class="order-track-text">
                                    <p class="order-track-text-stat">Shipping to - 运送至 - 789 New City St. 云南省, 中国</p>
                                    <span class="order-track-text-sub">arrived</span>
                                </div>
                            </div>
                            <div class="order-track-step">
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleViewPayment{{ $order->uuid }}" tabindex="-1" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-start">
                <p class="lead">Payment Methods:</p>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td>Amount:</td>
                                    <td class="text-right">$
                                        {{ $payment ? number_format($payment->amount_submitted, 2) : 0.0 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bank name:</td>
                                    <td class="text-right">{{ $payment ? $payment->bank_name : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Acc name:</td>
                                    <td class="text-right">{{ $payment ? $payment->bank_account_name : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Acc number:</td>
                                    <td class="text-right">{{ $payment ? $payment->bank_account_number : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Remarks:</td>
                                    <td class="text-right">{{ $payment ? $payment->remarks : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td class="text-right">{{ $payment ? $payment->state : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Approved By:</td>
                                    <td class="text-right">
                                        {{ $payment && $payment->approved_by_id ? $payment->approve_by->name : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Approved At:</td>
                                    <td class="text-right">
                                        {{ $payment && $payment->approved_at ? $payment->approved_at->format('d m y H:i') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Receipt:</td>
                                    <td class="text-right">
                                        @if ($payment && !is_null($payment->proof_file_path))
                                            <a target="_blank"
                                                href="{{ asset('storage/' . $payment->proof_file_path) }}">
                                                <span>Receipt Proof</span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($buttons as $button)
    <div class="modal fade" id="exampleSupplierShip{{ $order->uuid }}" tabindex="-1" aria-labelledby="exampleSupplierShip{{ $order->uuid }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-start">
                    <h5 class="modal-title" id="exampleSupplierShip{{ $order->uuid }}Label"><b>{{ $button['title'] }}</b></h5>
                    <form action="{{ route('seller.order.update', $order->uuid) }}" method="post">
                        <input type="hidden" name="new_state" value="{{ $button['state'] }}">
                        <input type="hidden" name="old_state" value="{{ $order->state }}">
                        <div class="mb-4">
                            {{ $button['description'] }}
                        </div>
                        @method('put')
                        @csrf
                        <div class="mt-3">
                            <div class="row">
                                <div class="col text-start">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                <div class="col text-end">
                                    <button class="btn btn-danger">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
