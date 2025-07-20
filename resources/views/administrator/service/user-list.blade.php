@foreach ($services as $service)
    <div class="item d-flex align-items-center">
        <div class="image">
            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="..." class="img-fluid rounded-circle">
        </div>
        <a href="{{ route('administrator.service-chat.user', ['id' => $service->user_id]) }}" class="text">
            
            <h3 class="h5">{{ ($service->user->fname)?$service->user->fname:($service->user->email?$service->user->email:$service->user->phone) }} {{ $service->user->Lname?$service->user->Lname:'' }}</h3>
            
            <small>{{ $service->created_at->format('Y-m-d H:i') }}</small>
            <small>{{ $service->message }}</small>
        </a>
    </div>    
@endforeach