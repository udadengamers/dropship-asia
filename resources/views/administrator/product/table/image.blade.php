<a href="{{ route('administrator.product.edit', $product->uuid) }}">
    <img src="{{ url('storage/'.$product->product_images->first()->path_file) }}" class="img-fluid" style="min-height: 70px !important; max-height: 70px !important;"
        alt="product.title" />
</a>