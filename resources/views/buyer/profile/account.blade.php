@extends('layouts.main')
@section('bodyDR')
  <div class="account-container">
    {{-- EDIT PROFILE MODAL --}}
    <div class="edit-profile d-none" id="image-change-modal">
      <form action="/update-profile" class="edit-profile-body" method="POST" enctype="multipart/form-data">
        @method('POST')
        @csrf    
        @if ( auth()->user()->buyer_detail)
          @if (auth()->user()->buyer_detail->profile_pict)
              <img src="{{ url('storage/'.auth()->user()->buyer_detail->profile_pict) }}" alt="">
              <input type="hidden" name="oldPic" value="{{ auth()->user()->buyer_detail->profile_pict }}">
          @else
              <img src="{{ asset("/img/temp-img-profile.png") }}" alt="">
          @endif
        @else
          <img src="{{ asset("/img/temp-img-profile.png") }}" alt="">
        @endif
        <input type="hidden" name="type_form" value="image">
        
        <div class="mb-3">
          <label for="formFile" class="form-label mt-3">Upload your image</label>
          <input class="form-control m-0 @error('profile_pict') is-invalid  @enderror" style="width: auto" type="file" id="formFile" name="profile_pict">
          @error('profile_pict')
            <div class="invalid-feedback d-none">{{ $message }}</div>
          @enderror
        </div>
        <div class="button-edit-profile-body">
          <button type="submit">Update</button>
          <button type="button" class="cancel-edit">Cancel</button>
        </div>
      </form>
    </div>
    <div class="edit-profile d-none" id="data-change">
      <form action="/update-profile" class="edit-profile-body" method="POST">
        @method('POST')
        @csrf    
        <div class="name-profile">
          <input type="hidden" name="type_form" value="user">
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
          <input type="text" name="fname" placeholder="First Name">
          <input type="text" name="lname" placeholder="Last Name">
        </div>
        {{-- <input type="text" name="phone" placeholder="phone number"> --}}
        @if (!(auth()->user()->email))            
          <input type="email" name="email" placeholder="Add New Email">
        @endif

        <div class="button-edit-profile-body">
          <button type="submit">Update</button>
          <button type="button" class="cancel-edit">Cancel</button>
        </div>
      </form>
    </div>
    <div class="edit-profile d-none" id="address-change">
      <form action="/update-profile" class="edit-profile-body" method="POST">   
        @method('POST')
        @csrf       
        <div class="update-address">
          <input type="hidden" name="type_form" value="buyer_detail">
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
          <textarea name="address_one" id="address1" placeholder="{{ (auth()->user()->buyer_detail?->address_one)?auth()->user()->buyer_detail->address_one:"address 1" }}" ></textarea>
          <textarea name="address_two" id="address2" placeholder="{{ (auth()->user()->buyer_detail?->address_two)?auth()->user()->buyer_detail->address_two:"address 2" }}"  ></textarea>
        </div>

        <div class="button-edit-profile-body">
          <button type="submit">Update</button>
          <button type="button" class="cancel-edit">Cancel</button>
        </div>
      </form>
    </div>
    <div class="edit-profile d-none" id="password-change">
      <form class="edit-profile-body" method="POST">   
        @method('POST')
        @csrf    
        <label for="mailconfirm">Change Password Request</label>   
        <p class="" style="width:100%;text-align:center;">We'll send you an email with instructions to reset your password.</p>
        {{-- <label for="mailconfirm" style="width:100%;display:flex;justify-content:start;" class="pl-5 pb-0 mb-0">Email</label>  --}}
        @if (auth()->user()->email)
          <input type="hidden" id="mailconfirm" value="{{ auth()->user()->email }}" name="email" placeholder="example@mail.com">
            
        @endif

        <div class="button-edit-profile-body">
          <button type="button" style="width: auto;" data="{{ auth()->user()->uuid }}" onclick="passwordChange(this)">Send Verification Email</button>
          <button type="button" class="cancel-edit">Cancel</button>
        </div>
      </form>
    </div>
    
    
    <div class="account-body">
      <div class="buyer-profile-body">

        <div class="title-profile">
          <div class="curved-background">
            <div class="curved-background__curved"></div>
          </div>
          @if ( auth()->user()->buyer_detail)
            @if (auth()->user()->buyer_detail->profile_pict)
                <img src="{{ url('storage/'.auth()->user()->buyer_detail->profile_pict) }}" class="profile-img" alt="">
            @else
                <img src="{{ asset("/img/temp-img-profile.png") }}" class="profile-img"  alt="">
            @endif
          @else
            <img src="{{ asset("/img/temp-img-profile.png") }}" class="profile-img"  alt="">
          @endif      
          {{-- <div class="profile-img">
            
          </div>     --}}
          <div class="profile-data">
            @if (auth()->user()->fname)
                @if (auth()->user()->lname)
                  <h3>{{ auth()->user()->fname }} {{ auth()->user()->lname }}</h3>
                @else
                  <h3>{{ auth()->user()->fname }}</h3>
                @endif
            @else
                <h3>ID: {{ auth()->user()->uuid }}</h3>
            @endif
            
            <h5>{{ auth()->user()->phone }}</h5>
            <h5>{{ auth()->user()->email }}</h5>
          </div>     
        </div>
        {{-- @if (auth()->user()->type == "seller") --}}
          <div class="profile-description">
            <div class="profile-balance pl-3 pr-3">
              <h5 class="p-0 m-0"><i style="font-size: 14px" class="fas fa-wallet"></i> My Purse</h5>
              <a href="/wallet" class="text-muted" style="margin:0;width:auto;height:auto;color:black;" > <h5 class="p-0 m-0">Wallet <i style="font-size: 14px" class="fas fa-chevron-right"></i></h5> </a>
              
            </div>
            <div class="profile-balance" style="margin-left:80px ;margin-right:80px ;">
              <div class="my-balance">
                <h4>${{ auth()->user()->balance }}</h4>
                <h5>balance</h5>
              </div>
              <div class="my-balance">
                <h4>0</h4>
                <h5>Coupon</h5>
              </div>
            </div>
          </div>            
        {{-- @endif --}}

        <div class="profile-description">
          <a class="address-button-change"><i class="fas fa-map-marked-alt"></i><p>Shipping Address</p></a>
          <a class="edit-button-container"><i class="fas fa-id-card"></i><p>Edit Profile</p></a>
          @if (auth()->user()->type == "seller")
          <a href="/seller/profile"><i class="fas fa-store"></i><p>My Shop Profile</p></a>
          @else
          <a href="/seller"><i class="fas fa-store"></i><p>Become A Seller</p></a>
          @endif
          {{-- <a ><i class="fas fa-clipboard-list"></i></i><p>Transaction</p></a> --}}
          <a href="/service">
            <i class="fas fa-headset" style="position: relative;">
              @if ( count($badgecs) > 0 )
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  {{ count($badgecs) }}
                </span>
              @endif
            </i>
            
            <p>Service</p>
          </a>
          <a href="/topup-select"><i class="fas fa-file-invoice-dollar"></i><p>Topup</p></a>
          <a class="password-button-change" onclick="pcModal(this)"><i class="fas fa-lock"></i><p>Change Password</p></a>
          {{-- <a ><i class="fas fa-bell"></i><p>Notice</p></a> --}}
          <a href="/logout"><i class="fas fa-power-off"></i><p>Sign out</p></a>
        </div>
      </div>
      <div class="order-body-account">
        @include('buyer.order.order')

      </div>

    </div>
  </div>

  
  


@endsection