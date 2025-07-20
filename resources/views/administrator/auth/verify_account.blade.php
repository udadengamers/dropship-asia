<x-seller.guest-layout>
    <div class="row justify-content-center align-items-center p-2">
        <div class="m-1 col-sm-8 col-md-6 col-lg-4 shadow-sm p-3 mb-5 bg-white border rounded">
            <div class="pt-5 pb-5">
                {{-- <img class="rounded mx-auto d-block" src="https://freelogovector.net/wp-content/uploads/logo-images-13/microsoft-cortana-logo-vector-73233.png" alt="" width=70px height=70px> --}}
                <p class="text-center text-uppercase mt-3">Verify your account</p>
                <form class="form" action="{{ route('seller.authenticate') }}" method="POST">
                    @csrf
                    <div class="form-group input-group-md mb-3">
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group input-group-md mb-3">
                        <input type="text" class="form-control" name="phone_number" id="phone_number" aria-describedby="phone_numberHelp" placeholder="Enter phone number">
                        @if ($errors->has('phone_number'))
                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                        @endif
                    </div>
                    <button class="btn btn-sm btn-block btn-primary mt-4" type="submit">
                        Send Back
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-seller.guest-layout>