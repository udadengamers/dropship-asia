<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\User;
use App\Traits\Nexmo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    use Nexmo;

    public function index()
    {
        return view('seller.auth.login');
    }

    public function authenticate(Request $request)
    {
        $rule = $request->phone ? ($request->email ? 'required' : 'sometimes') : 'required';

        $messages = [
            'input.required' => 'Email Or Phone Number is required.',
            'password.required' => 'Password is required.'
        ];

        $request->validate([
            'input' => 'required',
            'password' => 'required|string',
        ], $messages);

        $validated_phone = false;

        $validated_email = false;

        if (filter_var($request->input, FILTER_VALIDATE_EMAIL)) {
            $validated_email = true;
            $credentials = ['email' => $request->input, 'password' => $request->password];
        } else if (phone_validated($request->input)) {
            $credentials = ['phone' => $request->input, 'password' => $request->password];
            $validated_phone = true;
        } else {
            session()->flash('error', "You have entered invalid credentials");
            return redirect()->back();
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/seller/dashboard');
        }

        session()->flash(
            'error',
            "You have entered invalid credentials"
        );

        return redirect()->back();
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('seller.login');
    }

    public function register()
    {
        return view('seller.auth.register');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            if (Cookie::has('code')) {
                $code = Cookie::get('code');
                if ($code) {
                    if ($request->type == 'phone') {
                        if ($code != $request->verify_signup_text_phone) {

                            session()->flash('error', 'Verification number doest not match.');

                            return redirect('/seller/register')->withInput();
                        }
                    } else {
                        if ($code != $request->verify_signup_text_email) {

                            session()->flash('error', 'Verification number doest not match.');

                            return redirect('/seller/register')->withInput();
                        }
                    }
                } else {

                    session()->flash('error', 'Please hit Get Verification Number again to get number.');

                    return redirect('/seller/register')->withInput();
                }
            }

            $rules = [
                'email' => $request->phone ? 'nullable|sometimes|unique:users' : 'required|unique:users',
                'phone' => $request->email ? 'nullable|sometimes|unique:users' : 'required|unique:users',
            ];

            $validated_data = $request->validate([
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'email' => $rules['email'],
                'password' => 'required',
                'phone' => $rules['phone'],
            ]);

            $validated_data['password'] = Hash::make($validated_data['password']);

            $validated_data['remember_token'] = Str::random(10);

            $validated_data['type'] = 'seller';

            $validated_data['wallet_address'] = Str::random(60, 'alnum');

            $validated_data['state'] = 'active';

            if ($request->type == 'phone') {
                $validated_data['otp'] = $request->verify_signup_text_phone;
                $validated_data['otp_expired_at'] = now()->addDays(1);
                $validated_data['otp_verified_at'] = now();
            } else {
                $validated_data['email_verified_at'] = now();
            }

            $seller = User::create($validated_data);

            DB::commit();

            return redirect('/seller/login')->with('success', 'Registration Successfully! Please Login');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }

    public function verify_account($email, $token)
    {
        $verify_seller = User::where('email', $email)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verify_seller)) {
            $seller = $verify_seller;
            if (!$seller->email_verified_at) {
                $seller->update([
                    'email_verified_at' => now()
                ]);
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('seller.login')->with('message', $message);
    }
}
