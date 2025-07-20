<x-admin.auth-layout>

    <section class="card">
        <div class="card-body">
            <!-- Order Company Details -->
            <div id="order-company-details" class="row">
                <div class="col-md-6 col-sm-12 text-center text-md-left">
                    <div class="media">

                        <div class="media-body ">
                            <ul class="ml-2 px-0 list-unstyled">
                                <li class="text-bold-800"><b>{{ $order->shop->name }}</b></li>
                                <li>{{ $order->shop->phone_number ?? $order->shop->user->phone }}</li>
                                <li>{{ $order->shop->user->email }}</li>
                                <li>{{ $order->shop->address }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 text-center text-md-right">
                    <h2>ORDER</h2>
                    <p class="pb-3"># {{ $order->trx_code }}</p>
                    <ul class="px-0 list-unstyled">
                        <li>Balance Due</li>
                        <li class="lead text-bold-800">$ {{ number_format($order->total, 2) }}</li>
                    </ul>
                </div>
            </div>
            <!--/ Order Company Details -->
            <!-- Order Customer Details -->
            <div id="order-customer-details" class="row pt-2">
                <div class="col-sm-12 text-center text-md-left">
                    <p class="text-muted">Bill To</p>
                </div>
                <div class="col-md-6 col-sm-12 text-center text-md-left">
                    <ul class="px-0 list-unstyled">
                        <li class="text-bold-800"><b>{{ $order->user->fname }} {{ $order->user->lname }}</b></li>
                        <li>{{ $order->user->phone ?? '-' }}</li>
                        <li>{{ $order->user->email ?? '-' }}</li>
                        <li>{{ $order->user->buyer_detail->address_one ?? '-' }}</li>
                        <li>{{ $order->user->buyer_detail->address_two ?? '-' }}</li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 text-center text-md-right">
                    <p>
                        <span class="text-muted">Order Date :</span> {{ $order->order_date->format('d/m/y') }}
                    </p>
                    <p>
                        <span class="text-muted">Shipping Number :</span> {{ $order->shipping_number ? $order->shipping_number : '-' }}
                    </p>
                    <p>
                        <span class="text-muted">Shipping Date :</span> {{ $order->shipping_date ? $order->shipping_date->format('d/m/y H:i') : '-' }}
                    </p>
                    {{-- <p>
                    <span class="text-muted">Terms :</span> Due on Receipt
                </p>
                <p>
                    <span class="text-muted">Due Date :</span> 10/05/2016
                </p> --}}
                </div>
            </div>
            <!--/ Order Customer Details -->
            <!-- Order Items Details -->
            <div id="order-items-details" class="pt-2">
                <div class="row">
                    <div class="table-responsive col-sm-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item &amp; Description</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Variant</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_amount = 0 @endphp
                                @foreach ($order->order_items as $order_item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <p>{{ $order_item->product?->name }}</p>
                                        </td>
                                        <td class="text-right">$ {{ number_format($order_item->stock_price, 2) }}</td>
                                        <td class="text-right">{{ $order_item->stock_name }}</td>
                                        <td class="text-right">{{ $order_item->quantity }}</td>
                                        <td class="text-right">$ {{ number_format($order_item->sub_total, 2) }}</td>
                                    </tr>
                                    @php $total_amount += $order_item->sub_total @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Note:</td>
                                    <td colspan="4">{{ $order->note ?? '-' }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 col-sm-12 text-center text-md-left">
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
                    <div class="col-md-5 col-sm-12">
                        <p class="lead">Total due</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td class="text-right">$ {{ number_format($total_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>TAX (0%)</td>
                                        <td class="text-right">$ 0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Price</td>
                                        <td class="text-right">$ {{ number_format($order->total - $total_amount, 2) }}
                                        </td> {{-- temp --}}
                                    </tr>
                                    <tr class="bg-grey bg-lighten-4">
                                        <td class="text-bold-800">Total</td>
                                        <td class="text-bold-800 text-right">$ {{ number_format($order->total, 2) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Footer -->
            <div id="order-footer">
                <div class="row">
                    <div class="col">
                        @include('administrator.order.parts.button', [
                            'type' => 'show',
                            'payment' => $payment,
                            'order' => $order,
                        ])
                    </div>
                </div>
            </div>
            <!--/ Order Footer -->
        </div>
    </section>
</x-admin.auth-layout>
