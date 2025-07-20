<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Requests\Admin\SellerRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            if (request()->get('tab') == 'active') {
                $data = User::seller()->active();
            } else if (request()->get('tab') == 'inactive') {
                $data = User::seller()->where('state', 'inactive');
            } else {
                $data = User::seller();
            }
            $data->orderByDesc('id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->fname . ' ' . $row->lname;
                })
                ->addColumn('action', function ($row) {
                    $data['seller'] = $row;
                    return view('administrator.seller.table.action', $data);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('administrator.seller.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['seller'] = new User();

        return view('administrator.seller.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellerRequest $request)
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
                'type' => 'seller',
            ]);

            $user->buyer_detail()->create([
                'address_one' => $request->address_one,
                'address_two' => $request->address_two,
                'date_of_birth' => date('Y-m-d H:i:s', strtotime($request->date_of_birth)),
                'phone_number' => $request->phone,
            ]);

            $user->shop()->Create([
                'name' => $request->shop_name,
                'slug' => Str::slug($request->shop_name),
                'description' => $request->description,
                'phone_number' => $request->shop_phone_number,
                'contact_person' => $request->contact_person_name,
                'id_card' => $request->id_card,
                'address' => $request->shop_address,
                'type' => $request->type,
                'state' => $request->state ?? 'active',
            ]);

            session()->flash('success', 'Seller has been created.');

            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
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
        $seller = User::where('uuid', $uuid)->firstOrFail();

        $data['seller'] = $seller;

        return view('administrator.seller.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SellerRequest $request, $uuid)
    {
        try {
            // validation

            $user = User::where('uuid', $uuid)->firstOrFail();

            DB::beginTransaction();

            $user->update([
                'fname' => $request->fname,
                'lname' =>  $request->lname,
                'email' => $request->email,
                'phone' => $request->phone,
                'wallet_address' => $request->wallet_address,
                'state' => $request->state,
                'type' => 'seller',
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

            $user->shop()->updateOrCreate([
                'user_id'   => $user->id,
            ], [
                'name' => $request->shop_name,
                'slug' => Str::slug($request->shop_name),
                'description' => $request->description,
                'phone_number' => $request->shop_phone_number,
                'contact_person' => $request->contact_person_name,
                'id_card' => $request->id_card,
                'address' => $request->shop_address,
                'type' => $request->type,
                'state' => $request->state ?? 'active',
            ]);

            session()->flash('success', 'Seller has been updated.');

            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
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
