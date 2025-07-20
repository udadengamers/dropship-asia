<x-seller.guest-layout>
    @section('title', 'Register')
    <style>
        @media (max-width: 767.98px) {
            #formLoginWrapper .p-5 {
                padding: 1rem !important;
            }
        }
    </style>
    <div class="container" id="formLoginWrapper">
        <div class="row py-5 mt-4 align-items-center">
            <!-- For Demo Purpose -->
            <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
                <img src="/img/1103_U1RVRElPIEtBVCAwNzMtMDE.jpg" alt=""
                    class="img-fluid mb-3 d-none d-md-block rounded-2">
                <h1>Join Our Marketplace as a Seller</h1>
                <p class="font-italic text-muted mb-0">
                    Ready to sell your products to a wider audience? Register your shop as a seller on our platform and gain access to powerful marketing tools, analytics, and a supportive community. Our user-friendly interface makes it easy to manage your listings and orders, so you can focus on growing your business. Sign up now to start selling and reach new customers!
                </p>
            </div>

            <!-- Login Form -->
            <div class="col-md-7 col-lg-6 ml-auto p-5">
                <div class="row">
                    <div class="col text-center mb-3">
                        <h3>
                            SIGN UP
                        </h3>
                    </div>
                </div>
                <form action="/seller/register/store" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="phone">

                    <div class="row p-5">

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Number Phone</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                                    type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">Email</button>
    
                            </div>
                        </nav>
                        <div class="tab-content mt-3" id="nav-tabContent">
                            <div class="tab-pane fade show active " id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="form-group row mb-3">
                                    <div class="col-sm-4">
                                        <select class="form-control" name="country_code" id="country_code" aria-placeholder="Select">
                                            @include('main-partial.countrycode')
                                        </select>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" name="phone" class="form-control phone @error('phone') is-invalid  @enderror" placeholder="ex. 857213456" value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="invalid-feedback d-none">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="verify_signup_text_phone" value="{{ old('verify_signup_text_phone') }}" class="form-control">
                                    <div class="input-group-append">
                                        <button id="phoneVerify" type="button" class="w-100 verify-signup btn btn-primary-default" onclick="send_code('phone')">Get verification number</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" style="width: 100%;" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <div class="email-signup form-group mb-3">
                                    <input type="email" name="email"
                                        class="form-control email-signup-input @error('email') is-invalid  @enderror"
                                        placeholder="Email here" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback d-none">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="verify_signup_text_email" value="{{ old('verify_signup_text_email') }}" class="form-control verify-signup-text">
                                    <div class="input-group-append">
                                        <button id="emailVerify" type="button" class="w-100 btn btn-primary-default verify-signup" onclick="send_code('email')">Get verification email</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control rounded-top @error('fname') is-invalid  @enderror" name="fname" id="fname" required
                                value="{{ old('fname') }}" placeholder="First Name">
                            @if ($errors->has('fname'))
                                <span class="text-danger">{{ $errors->first('fname') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control rounded-top @error('lname') is-invalid  @enderror" name="lname" id="lname" required
                                value="{{ old('lname') }}" placeholder="Last Name">
                            @if ($errors->has('lname'))
                                <span class="text-danger">{{ $errors->first('lname') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control rounded-bottom @error('password') is-invalid  @enderror" name="password" id="password" required
                                placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end form-group col-lg-12 mx-auto mb-3 mt-3">
                            <button class="btn btn-primary-default w-100" type="submit">
                                Sign Up
                            </button>
                        </div>
                        <!-- Already Registered -->
                        <div class="text-center w-100">
                            Have an account? 
                            <a class="text-primary" href="/seller/login"> 
                                Login Here
                            </a>
                        </div>

                        <!-- Home -->
                        <div class="text-center w-100 mt-5">
                            <a class="nav-link text-primary" href="/"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                                </svg>
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script>
            $('button[data-bs-toggle="tab"]').on('click', function (e) {  
                var selectedTabId = e.target.id; 
                $('input[name="type"]').val(selectedTabId == 'nav-home-tab' ? 'phone' : 'email');
            });
            function send_code(type) {
                let tab = $('button[data-bs-toggle="tab"]').filter('.active').attr('id');

                let token = $("meta[name='csrf-token']").attr("content");
                let email = $('input[name="email"]').val();
                let phone = $('input[name="phone"]').val();
                let country_code = $('select[name="country_code"]').val();
                let url = '';
                var button = $('#'+type+'Verify');
                var button_text = button.text();

                if (type == 'email') {
                    url = '/send-code?email=' + email + '&type=' + type;
                } else {
                    url = '/send-code?phone=' + country_code + phone + '&type=' + type;
                }

                if (tab == 'nav-home-tab') {
                    if (!phone) {
                        alert('Phone Cannot be null.');
                        return false;
                    }
                } else {
                    if (!email) {
                        alert('Email Cannot be null.');
                        return false;
                    }
                }
                
                $('input[name="type"]').val(type);
                
                button.attr({
                    class: 'btn btn-primary-default verify-signup w-100',
                    disabled: true
                }).text('Loading...');

                fetch(url, {
                    method: 'get',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'url': '/checkout',
                        "X-CSRF-Token": token
                    }
                })
                .then((response) => response.json())
                .then(data => {
                    console.log(data)
                    if (data.message) {
                        button.attr({
                            class: 'btn btn-primary-default verify-signup w-100',
                            disabled: false
                        }).text(button_text)
                    }
                })
                .catch(function(error) {
                    alert(error)
                });
            }
        </script>
    @endpush
</x-seller.guest-layout>
