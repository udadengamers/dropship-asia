<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Topup;

class TopupController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Topup'
        ];
        return view('buyer.wallet.topup.index', $data);
    }

    public function record()
    {
        $topups = auth()->user()->topups();
        
        if (request()->has('tab')) {
            $topups->where('state', request()->tab);
        }

        if (request()->ajax()) {

    		$view = view('buyer.wallet.topup.item',['records' => $topups->orderByDesc('created_at')->paginate(10)])->render();

            return response()->json(['html'=>$view]);
        }

        $data = [
            'title' => 'Topup Record',
            'records' => $topups->orderByDesc('created_at')->paginate(10)
        ];
        return view('buyer.wallet.topup.record', $data);
    }

    public function store(Request $request)
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

            return view('buyer.wallet.topup.redirect', [
                'topup' => $topup
            ]);
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }

    public function method(Request $request)
    {
        $data = [
            'title' => 'Topup Method'
        ];
        return view('buyer.wallet.topup.select', $data);
    }
}
