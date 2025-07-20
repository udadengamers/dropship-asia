<x-seller.guest-layout>
    <div class="row justify-content-center align-items-center">
        <div class="m-1 col-sm-8 col-md-6 col-lg-4 shadow-sm p-3 mb-5 bg-white border rounded">
            <div class="pt-3 pb-3">
                <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
                <form action="/seller/register/store" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control rounded-top" name="name" id="name" required
                            value="{{ old('name') }}" placeholder="Name">
                        <label for="name">Name</label>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control " name="email" id="email" required
                            value="{{ old('email') }}" placeholder="name@example.com">
                        <label for="email">Email address</label>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control " name="phone_number" id="phone_number"
                            value="{{ old('phone_number') }}" placeholder="089671283612123">
                        <label for="phone_number">Phone Number</label>
                        @if ($errors->has('phone_number'))
                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                        @endif
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-bottom" name="password" id="password" required
                            placeholder="Password">
                        <label for="password">Password</label>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <button class="w-100 btn btn-sm btn-primary mt-3" type="submit">Register</button>
                </form>
                <small class="d-block mt-3">
                    Have an account? 
                    <a class="text-primary" href="/seller/login"> 
                        Login Here
                    </a>
                </small>
            </div>
        </div>
    </div>
    
</x-seller.guest-layout>