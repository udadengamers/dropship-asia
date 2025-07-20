
@foreach ($products as $product)
{{-- @if (($product->stocks->count() > 0) && ($product->stocks->first()->quantity > 0)) --}}
    <div class="col-md-3 col-sm-6 hp product d-none d-sm-block">
        <div class="card h-100 shadow-sm">
            <a href="{{ route('seller.product.show', $product->uuid) }}">
                <img src="{{ url('storage/'.$product->product_images->first()->path_file) }}" class="card-img-top"
                    alt="product.title" />
            </a>
            {{-- <div class="label-top shadow-sm">
                <a class="text-white" href="#">asus</a>
            </div> --}}
            <div class="card-body">
                <div class="clearfix mb-3">
                    <span class="float-start"><b>$ {{ number_format($product->stocks->first()->price) }}</b></span>

                    <span class="float-end">
                        <a href="{{ route('seller.product.show', $product->uuid) }}" class="small text-muted text-uppercase aff-link">Previews</a>
                    </span>
                </div>
                <h5 class="card-title">
                    <a target="_blank" href="#">
                        <b>{{ $product->name }}</b>
                    </a>
                    <br>
                    <span>
                        {!! $product->description !!}
                    </span>
                </h5>

                <div class="d-grid gap-2 my-4">

                    <form action="{{ route('seller.product.update', $product->uuid) }}" method="post">
                        @method('put')
                        @csrf
                        <button type="submit" class="w-100 btn btn-default bold-btn">Add to Shop</button>
                    </form>

                </div>
                {{-- <div class="clearfix mb-1">

                    <span class="float-start"><a href="#"><i
                                class="fas fa-question-circle"></i></a></span>

                    <span class="float-end">
                        <i class="far fa-heart" style="cursor: pointer"></i>

                    </span>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="col-6 hp product d-block d-sm-none mobile-col">
        <div class="card shadow-sm">
            <a href="{{ route('seller.product.show', $product->uuid) }}">
                <img src="{{ url('storage/'.$product->product_images->first()->path_file) }}" class="card-img-top" style="min-height: 150px !important; max-height: 150px !important;"
                    alt="product.title" />
            </a>
            {{-- <div class="label-top shadow-sm">
                <a class="text-white" href="#">asus</a>
            </div> --}}
            <div class="card-body" style="padding: 10px!important;">
                <div class="clearfix mb-3">
                    <span class="float-start"><b>$ {{ number_format($product->stocks->first()->price) }}</b></span>

                    <span class="float-end">
                        <a href="{{ route('seller.product.show', $product->uuid) }}" class="small text-muted text-uppercase aff-link">Previews</a>
                    </span>
                </div>
                <h5 class="card-title">
                    <a target="_blank" href="#">
                        <b>{{ $product->name }}</b>
                    </a>
                </h5>

                <div class="d-grid gap-2">

                    <form action="{{ route('seller.product.update', $product->uuid) }}" method="post">
                        @method('put')
                        @csrf
                        <button type="submit" class="w-100 btn btn-default btn-sm">Add to Shop</button>
                    </form>

                </div>
                {{-- <div class="clearfix mb-1">

                    <span class="float-start"><a href="#"><i
                                class="fas fa-question-circle"></i></a></span>

                    <span class="float-end">
                        <i class="far fa-heart" style="cursor: pointer"></i>

                    </span>
                </div> --}}
            </div>
        </div>
    </div>
{{-- @endif --}}
@endforeach