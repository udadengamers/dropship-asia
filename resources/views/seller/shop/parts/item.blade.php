
@foreach ($product_shops as $product_shop)
@if ($product_shop->product)
    @php $product = $product_shop->product; @endphp
    <div class="col-md-3 col-sm-6 hp product d-none d-sm-block">
        <div class="card h-100 shadow-sm">
            <a href="{{ route('seller.product.show', $product->uuid) }}">
                <img src="{{ url('storage/' . $product->product_images->first()->path_file) }}"
                    class="card-img-top" alt="product.title" />
            </a>
            <div class="card-body">
                <div class="clearfix mb-3">
                    <span class="float-start"><b>$
                            {{ number_format($product->stocks->first()->price) }}</b></span>

                    <span class="float-end">
                        <a href="{{ route('seller.product.show', $product->uuid) }}"
                            class="small text-muted text-uppercase aff-link">Previews</a>
                    </span>
                </div>
                <h5 class="card-title">
                    <a target="_blank" href="#">
                        <b>{{ $product->name }}</b>
                    </a>
                    <br>
                    <span>
                        {{ $product->description }}
                    </span>
                </h5>

                <div class="d-grid gap-2 my-4">
                    @if ($product_shop->state == 'added')
                        {{-- <form action="{{ route('seller.product.destroy', $product->uuid) }}"
                            method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="w-100 btn btn-default bold-btn">Remove
                                From Shop</button>
                        </form> --}}
                    @else
                        <form action="{{ route('seller.product.update', $product->uuid) }}"
                            method="post">
                            @method('put')
                            @csrf
                            <button type="submit" class="w-100 btn btn-default bold-btn">Add to
                                Shop</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="col-6 hp product d-block d-sm-none mobile-col">
        <div class="card h-100 shadow-sm">
            <a href="{{ route('seller.product.show', $product->uuid) }}">
                <img src="{{ url('storage/' . $product->product_images->first()->path_file) }}"
                    class="card-img-top" alt="product.title" />
            </a>
            <div class="card-body">
                <div class="clearfix mb-3">
                    <span class="float-start"><b>$
                            {{ number_format($product->stocks->first()->price) }}</b></span>

                    <span class="float-end">
                        <a href="{{ route('seller.product.show', $product->uuid) }}"
                            class="small text-muted text-uppercase aff-link">Previews</a>
                    </span>
                </div>
                <h5 class="card-title">
                    <a target="_blank" href="#">
                        <b>{{ $product->name }}</b>
                    </a>
                    <br>
                    <span>
                        {{ $product->description }}
                    </span>
                </h5>

                <div class="d-grid gap-2 my-4">
                    @if ($product_shop->state == 'added')
                        {{-- <form action="{{ route('seller.product.destroy', $product->uuid) }}"
                            method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="w-100 btn btn-default bold-btn">Remove
                                From Shop</button>
                        </form> --}}
                    @else
                        <form action="{{ route('seller.product.update', $product->uuid) }}"
                            method="post">
                            @method('put')
                            @csrf
                            <button type="submit" class="w-100 btn btn-default bold-btn">Add to
                                Shop</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@else
@endif
@endforeach