<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Wallet'
        ];
        return view('buyer.wallet.index', $data);
    }

    public function billing()
    {
        $wallets = auth()->user()->wallets()->order()->purchase();

        if (request()->ajax()) {

    		$view = view('buyer.wallet.parts.item',['wallets' => $wallets->orderByDesc('created_at')->paginate(10)])->render();

            return response()->json(['html'=>$view]);
        }

        $data = [
            'title' => 'Billing Details',
            'wallets' => $wallets->orderByDesc('created_at')->paginate(10)
        ];

        return view('buyer.wallet.billing', $data);
    }

    public function wallet_address()
    {
        $data = [
            'title' => 'Wallet Address'
        ];
        return view('buyer.wallet.wallet', $data);
    }

    public function store_wallet_address(Request $request)
    {
        if ($request->wallet_address) {
            auth()->user()->update([
                'wallet_address' => $request->wallet_address
            ]);
            session()->flash('success', 'Wallet Address has been updated.');
        } else {
            session()->flash('error', 'Wallet Address is required.');
        }

        return redirect()->route('wallet.index');
    }
}
