<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use App\Models\User;
use App\Models\BuyerDetail;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function registerview()
    {
        return view('buyer.auth.signup', [
            "title" => "signup"
        ]);
    }

    public function register(Request $request)
    {
        try {
            if (Cookie::has('code')) {
                $code = Cookie::get('code');
                if ($code) {
                    if ($request->type == 'phone') {
                        if ($code != $request->verify_signup_text_phone) {
                            return redirect('/signup')->with('error', 'Verification number doest not match.');
                        }
                    } else {
                        if ($code != $request->verify_signup_text_email) {
                            return redirect('/signup')->with('error', 'Verification number doest not match.');
                        }
                    }
                } else {
                    return redirect('/signup')->with('error', 'Please hit Get Verification Number again to get number.');
                }
            }

            DB::beginTransaction();
            if (!$request['phone'] && $request['phone'] == "") {
                $validatedData = $request->validate([
                    'email' => 'required|email:dns|unique:users',
                    'password' => 'required|min:5|max:255',
                    'confirm-password' => ['required_with:password', 'same:password', 'min:5'],
                ]);
            } else {
                $validatedData = $request->validate([
                    'phone' => 'required|unique:users|min:10',
                    'password' => 'required|min:5|max:255',
                    'confirm-password' => ['required_with:password', 'same:password', 'min:5'],
                ]);
                $validatedData['phone'] = ($request['country_code'] . $validatedData['phone']);
            }

            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['account_id'] = mt_rand(1000000000, 9999999999);

            if ($request->type == 'phone') {
                $validatedData['otp'] = $request->verify_signup_text_phone;
                $validatedData['otp_expired_at'] = now()->addDays(1);
                $validatedData['otp_verified_at'] = now();
            } else {
                $validatedData['email_verified_at'] = now();
            }
            $validatedData['remember_token'] = Str::random(10);

            $validatedData['wallet_address'] = Str::random(60, 'alnum');

            $validatedData['state'] = 'active';

            $user = User::create($validatedData);
            $buyerDetail = BuyerDetail::create([
                'user_id' => $user['id'],
                'profile_pict' => 'img/temp-img-profile.jpg',
            ]);

            DB::commit();

            Cookie::queue(Cookie::forget('code'));

            return redirect('/login')->with('success', 'account successful created, comfirm your account in your email now');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }

    public function loginview()
    {
        return view('buyer.auth.login', [
            "title" => "Login Form"
        ]);
        $view = view('buyer.auth.login', [
            "title" => "Login Form"
        ]);
        $json = response()->json(['message' => 'succes show view'], 201);

        return response()->withHeaders(['Content-Type' => 'application/json'])->setContent([$view, $json]);
    }

    public function logincheck(Request $request)
    {

        // dd($request);
        $validate = [];
        if ($request['email'] == null) {
            $validate = $request->validate([
                'phone' => 'required|min:10',
                'password' => ['required',]
            ]);
            $validate['phone'] = $request['country_code'] . $validate['phone'];
        } else {
            $validate = $request->validate([
                'email' => 'required|email:dns',
                'password' => 'required|min:5',
            ]);
        }
        $user = User::where('phone', $request->phone)->orWhere('email', $request->email)->first();
        if ($user) {
            if ($user->state == "inactive") {
                return redirect('/login')->with('error', 'This account has been banned because violate platform rules.');
            }
        }
        // @dd($validate);
        if (Auth::attempt($validate)) {

            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        echo "<script>
                alert('Wrong Password');
                location.href = '/login'
              </script>";
    }
    public function updateprofile(Request $request)
    {
        // dd(auth()->user()->buyer_detail);
        try {
            DB::beginTransaction();
            if (auth()->user()->buyer_detail) {
                $validatedData = [];
                if ($request['type_form'] == "user") {
                    $validatedData = $request->validate([
                        'fname' => 'max:20',
                        'lname' => 'max:20',
                        'email' => 'unique:users',
                        'phone' => '',
                    ]);
                    $updateData = array_filter($validatedData, function ($value) {
                        return $value !== null && $value !== '';
                    });
                    User::where('id', $request['user_id'])->update($updateData);
                } else if ($request['type_form'] == "buyer_detail") {
                    $validatedData = $request->validate([
                        'address_one' => 'max:255',
                        'address_two' => 'max:255',
                    ]);
                    $updateData = array_filter($validatedData, function ($value) {
                        return $value !== null && $value !== '';
                    });
                    BuyerDetail::where('user_id', $request['user_id'])->update($updateData);
                } else if ($request['type_form'] == "image") {
                    // dd($request);
                    $validatedData = $request->validate([
                        'profile_pict' => 'image|file|max:1024',
                    ]);
                    // @dd($validatedData['profile_pict']);
                    if ($request->file('profile_pict')) {
                        if ($request->oldPic) {
                            Storage::delete($request->oldPic);
                        }
                        $validatedData['profile_pict'] = $request->file('profile_pict')->store('user-profile-picture');
                        BuyerDetail::where('user_id', auth()->user()->id)->update($validatedData);
                    }
                }
            } else {
                BuyerDetail::create([
                    'user_id' => auth()->user()->id,
                    'profile_pict' => 'img/temp-img-profile.jpg',
                ]);
                $validatedData = [];
                if ($request['type_form'] == "user") {
                    $validatedData = $request->validate([
                        'fname' => 'max:20',
                        'lname' => 'max:20',
                        'email' => '',
                        'phone' => '',
                    ]);
                    $updateData = array_filter($validatedData, function ($value) {
                        return $value !== null && $value !== '';
                    });
                    User::where('id', $request['user_id'])->update($updateData);
                } else if ($request['type_form'] == "buyer_detail") {
                    $validatedData = $request->validate([
                        'address_one' => 'max:255',
                        'address_two' => 'max:255',
                    ]);
                    $updateData = array_filter($validatedData, function ($value) {
                        return $value !== null && $value !== '';
                    });
                    BuyerDetail::where('user_id', $request['user_id'])->update($updateData);
                } else if ($request['type_form'] == "image") {
                    // dd($request);
                    $validatedData = $request->validate([
                        'profile_pict' => 'image|file|max:1024',
                    ]);
                    // @dd($validatedData['profile_pict']);
                    if ($request->file('profile_pict')) {
                        if ($request->oldPic) {
                            Storage::delete($request->oldPic);
                        }
                        $validatedData['profile_pict'] = $request->file('profile_pict')->store('user-profile-picture');
                        BuyerDetail::where('user_id', auth()->user()->id)->update($validatedData);
                    }
                }
            }
            // dd($validatedData);

            DB::commit();

            return redirect()->back()->with('success', 'success updating data');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }
    public function editpassview(Request $request)
    {
        if ($request->input('dataverify')) {
            if ($request->input('dataverify') == auth()->user()->uuid) {
                return view('buyer.auth.password-change', [
                    'title' => 'Password Change',
                ]);
            } else {
                return redirect('/account')->with('error', 'invalid data link');
            }
        } else {
            return redirect('/');
        }
    }
    public function editpass(Request $request)
    {
        // dd($request->input('dataverify'));
        $validatedData = $request->validate([
            'password' => 'required|min:5|max:255',
            'confirm-password' => ['required_with:password', 'same:password', 'min:5'],
        ]);
        $password = Hash::make($validatedData['password']);
        User::where('uuid', $request->input('dataverify'))->update([
            'password' => $password,
        ]);
        return redirect('/account')->with('success', 'Password Success Change');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }
}
