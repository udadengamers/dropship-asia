<x-seller.guest-layout>
    @section('title', 'Login')
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
                <img src="https://bootstrapious.com/i/snippets/sn-registeration/illustration.svg" alt=""
                    class="img-fluid mb-3 d-none d-md-block">
                <h1>Login to Get Started with Our Platform</h1>
                <p class="font-italic text-muted mb-0">
                    Once you're logged in, you'll be able to connect with other members of our community, access premium content, and explore all that our platform has to offer. Don't have an account yet? No problem! Sign up today and start your journey with us.
                </p>
            </div>

            <!-- Login Form -->
            <div class="col-md-7 col-lg-6 ml-auto p-5">
                <div class="row">
                    <div class="col text-center mb-3">
                        <h3>
                            SIGN IN
                        </h3>
                    </div>
                </div>
                <form class="form" action="{{ route('seller.authenticate') }}" method="POST">
                    @csrf
                    <div class="row p-5">
                        <div class="form-group input-group-md mb-3">
                            <input type="text" class="form-control" name="input" id="input" aria-describedby="inputHelp" placeholder="Enter Email Or Phone">
                            @if ($errors->has('input'))
                                <span class="text-danger">{{ $errors->first('input') }}</span>
                            @endif
                        </div>
                        <div class="form-group input-group-md mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end form-group col-lg-12 mx-auto mb-3 mt-3">
                            <button class="btn btn-primary-default w-100" type="submit">
                                Sign In
                            </button>
                        </div>
                        <!-- Already Registered -->
                        <div class="text-center w-100">
                            <p class="text-muted font-weight-bold">Create an account? <a href="{{ route('seller.register') }}"
                                    class="text-primary ml-2">Sign Up</a></p>
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
</x-seller.guest-layout>
