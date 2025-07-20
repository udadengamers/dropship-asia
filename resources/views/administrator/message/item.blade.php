@foreach ($services as $service)
    @if ($service->owner == 'user')
        @if ($service->state != 'read')
            @php
                $service->update(['state' => 'read']);
            @endphp
        @endif
        <li class="sender" id="chat{{ $service->id }}">
            {!! $service->message ? "<p>$service->message</p>" : "<img src='".url('storage/'.$service->img_msg)."'/>" !!}
            <span class="time">{{ $service->created_at->diffForHumans() }}</span>
        </li>
    @else
        <li class="repaly" id="chat{{ $service->id }}">
            {!! $service->message ? "<p>$service->message</p>" : "<img src='".url('storage/'.$service->img_msg)."'/>" !!}
            <span class="time">{{ $service->created_at->diffForHumans() }}</span>
        </li>
    @endif
    @if ($loop->last)
        <input type="hidden" id="lastQuery" value="chat{{ $service->id }}">
    @endif
@endforeach