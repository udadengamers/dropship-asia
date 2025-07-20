<x-seller.auth-layout>
    @section('title', 'Order Details')
    <style>

        figure img {
            width: 8rem;
            height: 8rem;
            border-radius: 15%;
            border: 1.5px solid #f05a00;
            margin-right: 1.5rem;
            padding: 1rem;
        }

        figure figcaption {
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        figure figcaption h4 {
            font-size: 1.4rem;
            font-weight: 500;
        }

        figure figcaption h6 {
            font-size: 1rem;
            font-weight: 300;
        }

        figure figcaption h2 {
            font-size: 1.6rem;
            font-weight: 500;
        }

        .order-track {
            margin-top: 2rem;
            padding: 0 1rem;
            border-top: 1px dashed #2c3e50;
            padding-top: 2.5rem;
            display: flex;
            flex-direction: column;
        }

        .order-track-step {
            display: flex;
            height: 7rem;
        }

        .order-track-step:last-child {
            overflow: hidden;
            height: 4rem;
        }

        .order-track-step:last-child .order-track-status span:last-of-type {
            display: none;
        }

        .order-track-status {
            margin-right: 1.5rem;
            position: relative;
        }

        .order-track-status-dot {
            display: block;
            width: 2.2rem;
            height: 2.2rem;
            border-radius: 50%;
            background: #f05a00;
        }

        .order-track-status-line {
            display: block;
            margin: 0 auto;
            width: 2px;
            height: 7rem;
            background: #f05a00;
        }

        .order-track-text-stat {
            font-size: 1.3rem;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .order-track-text-sub {
            font-size: 1rem;
            font-weight: 300;
        }

        .order-track {
            transition: all .3s height 0.3s;
            transform-origin: top center;
        }
    </style>
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col">
                            {{ strtoupper('Order Number') }}: <b>{{ $order->trx_code }}</b>
                        </div>
                        <div class="col text-end">
                            <b>{{ strtoupper($order->states[$order->state] ?? $order->state) }}</b>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 ">
                            <p class="text-muted">Bill To</p>
                        </div>
                        <div class="col-md-6 col-sm-12 align-self-center">
                            <ul class="px-0 list-unstyled">
                                <li class="text-bold-800"><b>{{ $order->user->fname }} {{ $order->user->lname }}</b>
                                    ({{ $order->user->phone }})</li>
                                <li>{{ $order->user->buyer_detail?->address_one }}</li>
                                <li>{{ $order->user->buyer_detail?->address_two }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-12 align-self-center">
                            {{-- <p>
                                <span class="text-muted">Order Date :</span> {{ $order->order_date->format('d/m/y') }}
                            </p>
                            <p>
                                <span class="text-muted">Shipping Number :</span> {{ $order->shipping_number ? $order->shipping_number : '-' }}
                            </p>
                            <p>
                                <span class="text-muted">Shipping Date :</span> {{ $order->shipping_date ? $order->shipping_date->format('d/m/y H:i') : '-' }}
                            </p> --}}
                            {{-- <p>
                            <span class="text-muted">Terms :</span> Due on Receipt
                        </p>
                        <p>
                            <span class="text-muted">Due Date :</span> 10/05/2016
                        </p> --}}
                        </div>
                    </div>
                    <hr>

                    <div class="row mb-4">
                        <div class="col text-end">
                            @include('seller.order.parts.action')
                        </div>
                    </div>

                    <div>

                        @php $total_amount = 0 @endphp
                        @forelse ($order->order_items as $item)
                            <hr>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ url('storage/' . $item->product?->product_images?->first()->path_file) }}"
                                        class="img-fluid card-img-top" alt="product.title" />
                                </div>
                                <div class="col-md-6 align-self-center">
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $item->product->name }}</h6>
                                    {{-- <p class="card-text">{{ $item->product->description }}</p> --}}
                                    <p class="card-text">Variation: {{ ucwords($item->stock_name) }}</p>
                                    <p class="card-text">x {{ $item->quantity }}</p>
                                </div>
                                <div class="col-md-3 align-self-center text-end">
                                    <h6 class="card-subtitle mb-2 text-muted">$ {{ $item->sub_total }}</h6>
                                </div>
                            </div>
                            @php $total_amount += $item->sub_total @endphp
                        @empty
                            No Product
                        @endforelse
                    </div>

                    <div class="row mt-3">
                        <div class="mx-auto col"></div>
                        <div class="col-md-5 col-sm-12">
                            <p class="lead">Total due</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="text-end">$ {{ number_format($total_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>TAX (0%)</td>
                                            <td class="text-end">$ 0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Price</td>
                                            <td class="text-end">$ {{ number_format($order->shipping_price, 2) }}
                                            </td> {{-- temp --}}
                                        </tr>
                                        <tr class="bg-grey bg-lighten-4">
                                            <td class="text-bold-800">
                                                <h3>Total</h3>
                                            </td>
                                            <td class="text-bold-800 text-end">
                                                <h3>$ {{ number_format($order->total, 2) }}</h3>
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
    </div>
</x-seller.auth-layout>
