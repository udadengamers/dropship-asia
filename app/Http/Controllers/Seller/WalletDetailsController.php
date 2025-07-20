<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletDetailsController extends Controller
{
    public function billing(Request $request)
    {
        $wallets = auth()->user()->wallets()->orderBonus();

        if (request()->ajax()) {

    		$view = view('seller.wallet.parts.wallet.history',['wallets' => $wallets->orderByDesc('created_at')->paginate(7)])->render();

            return response()->json(['html'=>$view]);
        }

        $data['wallets'] = $wallets->orderByDesc('created_at')->paginate(7);

        $data['title'] = 'Billing Details';

        return view('seller.wallet.details', $data);
    }

    public function withdrawls(Request $request)
    {
        $withdraws = auth()->user()->withdraws();
        
        if ($request->has('tab')) {
            $withdraws->where('state', $request->tab);
        }

        if (request()->ajax()) {

    		$view = view('seller.wallet.parts.withdraw.history',['withdraws' => $withdraws->orderByDesc('created_at')->paginate(5)])->render();

            return response()->json(['html'=>$view]);
        }
        
        $data ['withdraws'] = $withdraws->orderByDesc('created_at')->paginate(5);
    
        $data['title'] = 'Withdrawal Record';

        return view('seller.wallet.details', $data);
    }

    public function topup(Request $request)
    {
        $topups = auth()->user()->topups();
        
        if ($request->has('tab')) {
            $topups->where('state', $request->tab);
        }

        if (request()->ajax()) {

    		$view = view('seller.wallet.parts.topup.history',['topups' => $topups->orderByDesc('created_at')->paginate(5)])->render();

            return response()->json(['html'=>$view]);
        }

        $data ['topups'] = $topups->orderByDesc('created_at')->paginate(5);

        $data['title'] = 'Topup Record';

        return view('seller.wallet.details', $data);
    }

    public function wallet_address()
    {
        return view('seller.wallet.create');
    }

    public function topup_select(Request $request)
    {
        return view('seller.topup.select');
    }

    public function withdraw_select(Request $request)
    {
        return view('seller.withdraw.select');
    }
}
