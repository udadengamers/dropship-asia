<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use Hash;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\UserRequest;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            if (request()->get('tab') == 'buyer') {
                $data = User::whereNull('type');
            } else if (request()->get('tab') == 'seller') {
                $data = User::seller();
            } else if (request()->get('tab') == 'active') {
                $data = User::active();
            } else if (request()->get('tab') == 'inactive') {
                $data = User::where('state', 'inactive');
            } else {
                $data = User::whereNotNull('id');
            }
            $data->orderByDesc('id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->fname . ' ' . $row->lname;
                })
                ->addColumn('action', function ($row) {
                    $data['user'] = $row;
                    return view('administrator.user.table.action', $data);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('administrator.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['user'] = new User();

        return view('administrator.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            // validation

            DB::beginTransaction();

            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'wallet_address' => $request->wallet_address,
                'email_verified_at' => now(),
                'otp' => Str::random(10),
                'otp_expired_at' => now()->addDays(1),
                'otp_verified_at' => now(),
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(10),
                'state' => $request->state,
            ]);

            $user->buyer_detail()->create([
                'address_one' => $request->address_one,
                'address_two' => $request->address_two,
                'date_of_birth' => date('Y-m-d H:i:s', strtotime($request->date_of_birth)),
                'phone_number' => $request->phone,
            ]);

            session()->flash('success', 'User has been created.');

            DB::commit();

            return view('administrator.user.index');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        $data['user'] = $user;

        return view('administrator.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $uuid)
    {
        try {
            // validation

            $user = User::where('uuid', $uuid)->firstOrFail();

            DB::beginTransaction();

            $user->update([
                'fname' => $request->fname,
                'lname' =>  $request->fname,
                'email' => $request->email,
                'phone' => $request->phone,
                'wallet_address' => $request->wallet_address,
                'state' => $request->state,
            ]);

            if ($user->buyer_detail) {
                $user->buyer_detail->update([
                    'address_one' => $request->address_one,
                    'address_two' => $request->address_two,
                    'date_of_birth' => date('Y-m-d H:i:s', strtotime($request->date_of_birth)),
                    'phone_number' => $request->phone,
                ]);
            } else {
                $user->buyer_detail()->create([
                    'address_one' => $request->address_one,
                    'address_two' => $request->address_two,
                    'date_of_birth' => date('Y-m-d H:i:s', strtotime($request->date_of_birth)),
                    'phone_number' => $request->phone,
                ]);
            }

            session()->flash('success', 'User has been updated.');

            DB::commit();

            return redirect()->back()->withInput();
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
