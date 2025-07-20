@php
   $button = $order->admin_button_actions() ? $order->admin_button_actions()[0] : []; 
@endphp
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Details
    </button>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" href="{{ route('administrator.order.show', $order->uuid) }}">Details</a>
        </li>
        @if ($button)
            @if ($payment && in_array($payment->state, ['in_review']) && $order->state == 'payment_submitted')
                <li>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#orderApproval{{ $order->uuid }}">Confirm</a>
                </li>
            @else
                <li>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Shipping{{ $order->uuid }}">Shipping</a>
                </li>
            @endif
        @endif
    </ul>
</div>

@if ($button)
    @if ($payment && in_array($payment->state, ['in_review']) && $order->state == 'payment_submitted')
        <div class="modal fade" id="orderApproval{{ $order->uuid }}"
            tabindex="-1"
            aria-labelledby="orderApproval{{ $order->uuid }}Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="modal-title"
                                    id="orderApproval{{ $order->uuid }}Label">
                                    <b>{{ $button['title'] }}</b>
                                </h5>
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn"
                                    data-bs-dismiss="modal">x</button>
                            </div>
                        </div>
                        <form
                            action="{{ route('administrator.order-payment.update', $payment->uuid) }}"
                            method="post">
                            @method('put')
                            @csrf
                            <div class="my-4">
                                {{ $button['description'] }}
                            </div>
                            @csrf
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col text-start">
                                        <button type="submit" name="btn" value="rejected"
                                            class="btn btn-danger">Reject</button>
                                    </div>
                                    <div class="col text-end">
                                        <button type="submit" name="btn" value="approved"
                                            class="btn btn-success">Approve</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="modal fade" id="Shipping{{ $order->uuid }}"
            tabindex="-1"
            aria-labelledby="Shipping{{ $order->uuid }}Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="modal-title"
                                    id="Shipping{{ $order->uuid }}Label">
                                    <b>{{ $button['title'] }}</b>
                                </h5>
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn"
                                    data-bs-dismiss="modal">x</button>
                            </div>
                        </div>
                        <form
                            action="{{ route('administrator.order.update', $order->uuid) }}"
                            method="post">
                            @method('put')
                            @csrf
                            <div class="my-4">
                                <input class="form-control" type="text" name="shipping_number" id="shipping_number" required>
                            </div>
                            @csrf
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col text-end">
                                        <button type="submit" name="btn"
                                            value="shipping"
                                            class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    @endif
@endif