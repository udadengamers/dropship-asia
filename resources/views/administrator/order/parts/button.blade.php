
@if ($payment && in_array($payment->state, ['in_review']) && $order->state == 'payment_submitted')
    @php
        $buttons = $order->admin_button_actions();
    @endphp

    @foreach ($buttons as $button)
        @if ($type == 'show')
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#exampleModal{{ $order->uuid }}{{ $button['state'] }}">Approve
                Payment
            </button>
        @else
            <li>
                <a class="dropdown-item" data-bs-toggle="modal"
                    data-bs-target="#exampleModal{{ $order->uuid }}{{ $button['state'] }}">Payment</a>
            </li>
        @endif

        <div class="modal fade" id="exampleModal{{ $order->uuid }}{{ $button['state'] }}"
            tabindex="-1"
            aria-labelledby="exampleModal{{ $order->uuid }}{{ $button['state'] }}Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="modal-title"
                                    id="exampleModal{{ $order->uuid }}{{ $button['state'] }}Label">
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
    @endforeach
@else
    @php
        $buttons = $order->admin_button_actions();
    @endphp

    @foreach ($buttons as $button)

        @if ($type == 'show')
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                data-bs-target="#Shipping{{ $order->uuid }}{{ $button['state'] }}">Shipping</button>
        @else
            <li>
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Shipping{{ $order->uuid }}{{ $button['state'] }}">Shipping</a>
            </li>
        @endif

        <div class="modal fade" id="Shipping{{ $order->uuid }}{{ $button['state'] }}"
            tabindex="-1"
            aria-labelledby="Shipping{{ $order->uuid }}{{ $button['state'] }}Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="modal-title"
                                    id="Shipping{{ $order->uuid }}{{ $button['state'] }}Label">
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
    @endforeach
@endif