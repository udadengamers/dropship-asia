@foreach ($orders as $order)
    @php $item = $order->order_items()->first(); @endphp
    @if ($item)
        <div class="row">
            <div class="col">
                <a class="nav-link" href="{{ route('seller.order.show', $order->uuid) }}">
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            <div class="row">
                                <div class="col">
                                    {{ strtoupper('Order Number') }}: <b>{{ $order->trx_code }}</b>
                                </div>
                                <div class="col text-end">
                                    <b>{{ strtoupper($order->states[$order->state] ?? $order->state) }}</b>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ url('storage/'.$item->product?->product_images?->first()->path_file) }}"
                                        class="img-fluid" alt="product.title" />
                                </div>
                                <div class="col-md-6 align-self-center">
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $item->product->name }}</h6>
                                    <p class="card-text">Variation: {{ ucwords($item->stock_name) }}</p>
                                    <p class="card-text">x {{ $item->quantity }}</p>
                                </div>
                                <div class="col-md-3 align-self-center text-end">
                                    <h6 class="card-subtitle mb-2 text-muted">$ {{ $item->sub_total }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    Remarks: {{ $order->note ?? '-' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    Total Paid: <b><span class="text-danger">$ {{ $order->total }}</span></b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    Earn: <b><span class="text-danger">$ {{ $order->total * 0.15 }}</span></b>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="row">
                                <div class="col my-3">
                                    <a class="btn btn-success w-100" data-bs-toggle="modal"
                                        data-bs-target="#exampleContactCustomer{{ $order->uuid }}">Contact Customer</a>
                                </div>
                                <div class="col my-3">
                                    <a class="btn btn-primary-default w-100" data-bs-toggle="modal" 
                                    data-bs-target="#exampleSupplierShip{{ $order->uuid }}">Supplier Ship</a>
                                    @foreach ($order->button_actions() as $button)
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
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @else
        @include('seller.page.no_result')
    @endif
@endforeach