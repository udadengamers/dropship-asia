<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Seller\WithdrawRequest;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seller.withdraw.index', [
            'link' => $link = "https://codeanddeploy.com/category/laravel"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WithdrawRequest $request)
    {
        try {
            if (auth()->user()->balance < 10) {

                session()->flash('error', 'The minimum balance is $ 10');

                return redirect()->back();
            }

            DB::beginTransaction();

            $withdraw = auth()->user()->withdraws()->create([
                'user_id' => auth()->user()->id,
                'amount_submitted' => $request->amount_submitted,
                'network' => $request->recharge,
                'bank_name' => $request->amount_submitted,
                'bank_account_name' => $request->bank_account_name,
                'bank_account_number' => $request->bank_account_number,
                'remarks' => $request->remarks,
                'paid_at' => now(),
                'state' => 'in_review',
            ]);

            // session()->flash('success', 'Withdraw has been submitted.');

            DB::commit();

            return view('seller.withdraw.redirect', [
                'withdraw' => $withdraw
            ]);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
