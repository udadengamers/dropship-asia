@foreach ($orders as $order)    
    <a href="/my-transaction/detail/{{ $order->id }}">
        <div class="transaction-card-container">
            <div class="transaction-card">

                <div class="trans-card-header">

                    <div class="trans-head-left">
                        <div class="trans-logo">
                            <i class="fas fa-shopping-bag fa-2x"></i>
                        </div>
                        <div class="trans-left-desc">
                            <h4>Shopping</h4>
                            <h5> {{ $order->order_date->format('d M Y') }}</h5>
                        </div>
                        </div>

                        <div class="trans-head-right">
                        <h4>{{ ($order->states[$order->state] ?? $order->state) }}</h4>
                    </div>

                </div>
                <hr>

                <div class="trans-card-body">
                    <div class="trans-body-desc">
                        <div class="trans-body-img">
                            {{-- @dd($order->order_items[0]->product->product_images[0]->path_file) --}}
                            <img src="{{ url('storage/'.$order->order_items[0]->product->product_images[0]->path_file) }}" alt="">
                        </div>
                        <div class="trans-body-product-desc">
                            <p> {{ (strlen($order->order_items[0]->product->name) > 30)? substr($order->order_items[0]->product->name,0,30)."..." : $order->order_items[0]->product->name }} - {{ $order->order_items[0]->stock_name }}</p>                 
                            <h5>{{ $order->order_items[0]->quantity }} Item</h5>
                        </div>
                    </div>
                    @if (sizeof($order->order_items)-1 != 0)
                    <div class="trans-total-item-info">
                        <h5>+{{ sizeof($order->order_items)-1 }} other product more..</h5>
                    </div>
                    @endif
                </div>

                <div class="trans-card-footer">
                    <div class="trans-footer-left">
                        <h5>Total Amount</h5>
                        <h4>${{ $order->total }},-</h4>
                    </div>
                    <div class="trans-footer-right">
                    @if (in_array($order->state,['created','payment_rejected']))
                        <div class="row">
                        <div class="col">
                            <form id="form-payment" action="{{ route('payment.show', $order->uuid) }}" method="get">
                                @csrf
                                <button type="submit" form="form-payment" class="transaction-history-button mr-2">Pay</button>
                            </form>
                        </div>
                        <div class="col">
                            <form action="{{ route('transaction.cancelled', $order->uuid) }}" method="post">
                                @method('put')
                                @csrf
                                <button type="submit" class="transaction-history-button">Cancel</button>
                            </form>
                        </div>
                        </div>
                    @endif
                    @if ($order->state == 'shipping')
                        <form action="{{ route('transaction.received', $order->uuid) }}" method="post">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-danger">Item received</button>
                        </form>
                    @endif
                    </div>
                </div>

            </div>
        </div>
    </a>
@endforeach