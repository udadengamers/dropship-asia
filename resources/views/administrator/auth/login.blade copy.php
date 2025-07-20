<x-admin.guest-layout>
    <div class="row justify-content-center align-items-center">
        <div class="m-1 col-sm-8 col-md-6 col-lg-4 shadow-sm p-3 mb-5 bg-white border rounded">
            <div class="pt-3 pb-3">
                <p class="text-center text-uppercase mt-3">Login</p>
                <form class="form" action="{{ route('administrator.authenticate') }}" method="POST">
                    @csrf

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-email-tab" data-bs-toggle="pill" data-bs-target="#pills-email" type="button" role="tab" aria-controls="pills-email" aria-selected="true">Email</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-phone-tab" data-bs-toggle="pill" data-bs-target="#pills-phone" type="button" role="tab" aria-controls="pills-phone" aria-selected="false">Phone</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-email" role="tabpanel" aria-labelledby="pills-email-tab">
                            <div class="form-group input-group-md mb-3">
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-phone" role="tabpanel" aria-labelledby="pills-phone-tab">
                            <div class="form-group input-group-md mb-3">
                                <input type="phone" class="form-control" name="phone" id="phone" aria-describedby="phoneHelp" placeholder="Enter Phone Number">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group input-group-md mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <button class="btn btn-sm btn-block btn-primary mt-4" type="submit">
                        Login
                    </button>
                    <a href="#" class="float-right mt-2">Forgot Password? </a>
                </form>
            </div>
        </div>
    </div>
    
</x-admin.guest-layout>