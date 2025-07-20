<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $product->state == 'active' ? 'Edit' : 'Details' }}
    </button>
    <ul class="dropdown-menu">
        @if ($product->state == 'active')
            <li>
                <a class="dropdown-item" href="{{ route('administrator.product.edit', $product->uuid) }}">Edit</a>
            </li>
            <li>
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete{{ $product->uuid }}">Delete</a>
            </li>
        @else
            <li>
                <a class="dropdown-item" href="{{ route('administrator.product.show', $product->uuid) }}">Details</a>
            </li>
        @endif
    </ul>
</div>

@if ($product->state == 'active')
    <div class="modal fade" id="delete{{ $product->uuid }}" tabindex="-1" aria-labelledby="delete{{ $product->uuid }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-start">
                    <h5 class="modal-title mb-3" id="delete{{ $product->uuid }}Label">
                        <b>
                            Product Confirmation
                        </b>
                    </h5>
                    <form action="{{ route('administrator.product.destroy', $product->uuid) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="mb-4">
                            Are you sure you want to delete this product <b>{{ $product->name }}</b> ?
                        </div>
                        <div class="mt-3">
                            <div class="row">
                                <div class="col text-start">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                <div class="col text-end">
                                    <button name="btn" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif