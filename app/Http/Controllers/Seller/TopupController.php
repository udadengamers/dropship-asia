<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Seller\TopupRequest;

class TopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seller.topup.index', [
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
    public function store(TopupRequest $request)
    {
        try {

            DB::beginTransaction();

            if ($request->images) {
                $file_path = upload(auth()->user()->topups(), $request->images, auth()->user()->uuid, 'top-up', true);
            }

            $topup = auth()->user()->topups()->create([
                'amount_submitted' => $request->amount_submitted,
                'network' => $request->recharge,
                'proof_file_path' => $file_path ?? null,
                'remarks' => $request->remarks,
                'paid_at' => now(),
                'state' => 'in_review',
            ]);

            // session()->flash('success', 'Topup has been submitted.');

            DB::commit();

            return view('seller.topup.redirect', [
                'topup' => $topup
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
