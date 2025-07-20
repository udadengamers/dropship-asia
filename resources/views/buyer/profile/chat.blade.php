@foreach ($services as $service)

    @if ($service->owner == "user")
        <div class="d-flex flex-row justify-content-end mb-4 pt-1">
            <div>
                <div class="admin-chat">
                    @if ($service->img_msg)
                        <img src="{{ url('storage/'.$service->img_msg) }}" onclick="zoomImagePD(this)" imgName="{{ url('storage/'.$service->img_msg) }}" style="max-width: 100px;" alt="">
                        @if ($service->message)
                            <p class="small p-2 me-3 mb-1 text-white  bg-primary">{{ $service->message }}</p>                            
                        @endif
                        <p class="small me-3 mb-3  text-muted d-flex justify-content-end">{{ $service->created_at->format('H:i') }}</p>
                    @else
                        <p class="small p-2 me-3 mb-1 text-white  bg-primary">{{ $service->message }}</p>
                        <p class="small me-3 mb-3  text-muted d-flex justify-content-end">{{ $service->created_at->format('H:i') }}</p>
                        
                    @endif
                </div>
            </div>
            @if (auth()->user()->buyer_detail)
                @if (auth()->user()->buyer_detail->profile_pict)
                    <img class="img-user-service-chat" src="{{ url('storage/'.auth()->user()->buyer_detail->profile_pict) }}" style="border-radius: 50%;" alt="">
                @else
                    <img class="img-user-service-chat" src="{{ url('img/temp-img-profile.png') }}" style="border-radius: 50%;" alt="">
                @endif
            @else
                <img class="img-user-service-chat" src="{{ url('img/temp-img-profile.png') }}" style="border-radius: 50%;border;1px solid white;" alt="">
            @endif            
        </div>
    @else
        <div class="d-flex flex-row justify-content-start">
            <i class="fas fa-headset fa-2x"></i>
            <div>
                <div class="admin-chat">
                    @if ($service->img_msg)
                        <img src="{{ url('storage/'.$service->img_msg) }}" onclick="zoomImagePD(this)" imgName="{{ url('storage/'.$service->img_msg) }}" style="max-width: 100px;" alt="">
                        @if ($service->message)
                            <p class="small p-2 ms-3 mb-1 " style="background-color: #f5f6f7;">{{ $service->message }}</p>                            
                        @endif
                        <p class="small me-3 mb-3  text-muted d-flex justify-content-end">{{ $service->created_at->format('H:i') }}</p>
                    @else
                        <p class="small p-2 ms-3 mb-1 " style="background-color: #f5f6f7;">{{ $service->message }}</p>
                        <p class="small me-3 mb-3  text-muted d-flex justify-content-end">{{ $service->created_at->format('H:i') }}</p>
                        
                    @endif
                </div>
                
            </div>
        </div>
    @endif
    
    {{-- <div class="divider d-flex align-items-center mb-4">
        <p class="text-center mx-3 mb-0" style="color: #a2aab7;">Today</p>
    </div> --}}

    

@endforeach


