@php
   $button = $order->button_actions() ? $order->button_actions()[0] : []; 
@endphp

<a class="btn btn-success" href="{{ route('seller.order.show', $order->uuid) }}">Details</a>

@if ($button)
    <a class="btn btn-primary-default" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $order->uuid }}">Supplier Ship</a>
@endif

@if ($button)
    <div class="modal fade" id="exampleModal{{ $order->uuid }}" tabindex="-1" aria-labelledby="exampleModal{{ $order->uuid }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="exampleModal{{ $order->uuid }}Label"><b>{{ $button['title'] }}</b></h5>
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
@endif