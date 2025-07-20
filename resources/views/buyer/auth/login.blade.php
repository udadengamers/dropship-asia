@extends('layouts.main')
@section('bodyDR')
<div class="login-container">
    <div class="login-body">
       
        <div class="login-title">
            <img class="img-title-sign" src="{{ asset("img/s_logo.png") }}" alt=""><hr>
        </div>
        <div class="login-form">
            <form action="/login" method="post">
                @csrf
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Phone</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Email</button>
                      
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="phone-signup">
                            <select class="" name="country_code" id="" aria-placeholder="Select">
                                @include('main-partial.countrycode')
                            </select>
                            <input type="text" name="phone" class="phone @error('phone') is-invalid  @enderror" placeholder="Your phone number here" >
                            @error('phone')
                                <div class="invalid-feedback d-none">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="emphone-body">                    
                            <input type="text" name="email" class="login-emphone @error('email') is-invalid  @enderror" placeholder="Your email here" autofocus>
                            @error('email')
                                <div class="invalid-feedback d-none">{{ $message }}</div>
                            @enderror
                        </div>    
                    </div>
                    
                  </div>
                
                <div class="password-body">
                    <input type="password" name="password" class="password" required  placeholder="Please enter password">
                    <button type="button" class="password-signup"><i class="bi bi-eye-slash"></i></button>     
                </div>
                <p>Forgot password ? <a onclick="fgPassLogin(this)" style="color: blue">click here</a> </p>
                
                <button type="submit" class="login-button">Login</button>
                <p>dont have an account ? <a href="/signup">sign up</a> here.</p>
            </form>
        </div>
    </div>
</div>
<div class="modal-forgot-password d-none">
    <span class="background-fpass"></span>
    <div class="card text-center" style="width: 300px;height:300px;">
        <div class="card-header text-white" style="background-color: orangered;">Password Reset</div>
        <div class="card-body px-5">
            <p class="card-text py-2">
                Enter your email address and we'll send you an email with instructions to reset your password.
            </p>
            <div class="form-outline">
                <label class="form-label" for="typeEmail">Email input</label>
                <input type="email" id="typeEmail" class="form-control my-3" placeholder="@mail"/>
            </div>
            <a href="#" class="btn btn-primary w-100">Send Verification Code</a>
            <div class="d-flex justify-content-between mt-4">
                <a class="" href="#" onclick="closeModalFPL()">Cancel</a>
                <a class="" href="/signup">Register</a>
            </div>
        </div>
    </div>
</div>

@endsection