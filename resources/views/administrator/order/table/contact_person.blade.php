@if ($type == 'buyer')
    <div> 
        {{ $order->user->fname . ' ' . $order->user->lname }}
    </div>
    <div>
        <small>
            <b>Phone Number: </b>{{ $order->user->phone ?? '-'}}
        </small>
    </div>
    <div>
        <small>
            <b>Email: </b>{{ $order->user->email ?? '-'}}
        </small>
    </div>
@else
    <div class="">
        {{ $order->shop->name }}
    </div>
    <div>
        <small>
            <b>Phone Number: </b>{{ $order->shop->phone_number ? $order->shop->user->phone : '-' }}
        </small>
    </div>
    <div>
        <small>
            <b>Email: </b>{{ $order->shop->user->email ?? '-'}}
        </small>
    </div>
@endif