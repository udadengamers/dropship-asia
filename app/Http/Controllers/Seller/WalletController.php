<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (request()->ajax()) {
        //     $data = auth()->user()->wallets();
        //     return DataTables::of($data)
        //             ->editColumn('created_at', function ($item) {
        //                 return $item->created_at->format('d/m/y H:i');
        //             })
        //             ->editColumn('amount_in', function ($item) {
        //                 $amount = number_format($item->amount_in, 2);
        //                 return $item->amount_in != 0 ? "{$amount}" : '-';
        //             })
        //             ->editColumn('description', function ($item) {
        //                 return $item->description;
        //             })
        //             ->editColumn('amount_out', function ($item) {
        //                 $amount = number_format($item->amount_out, 2);
        //                 return $item->amount_out != 0 ? "{$amount}" : '-';
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }
        if (request()->get('tab') == 'topup') {
            $data['topups'] = auth()->user()->topups()->orderByDesc('created_at')->get();
        } else if (request()->get('tab') == 'withdraw') {
            $data['withdraws'] = auth()->user()->withdraws()->orderByDesc('created_at')->get();
        } else {
            $data['wallets'] = auth()->user()->wallets()->orderByDesc('created_at')->get();
        }

        return view('seller.wallet.index', $data);
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
    public function store(Request $request)
    {
        if ($request->wallet_address) {
            auth()->user()->update([
                'wallet_address' => $request->wallet_address
            ]);
            session()->flash('success', 'Wallet Address has been updated.');
        } else {
            session()->flash('error', 'Wallet Address is required.');
        }

        return redirect()->back();
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
