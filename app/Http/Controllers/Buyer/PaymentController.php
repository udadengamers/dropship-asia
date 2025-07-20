<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentBuyer;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentController extends Controller
{
    public function show(Request $request, $uuid)
    {
        $order = auth()->user()->orders()->where('uuid', $uuid)->first();

        if ($order) {

            if ($order->payments()->whereIn('state', ['in_review','approved'])->first()) {
    
                session()->flash('warning', 'The payment has already been made.');

                return redirect('/account');
            }

            $data = [
                'title' => 'Payment',
                'order' => $order
            ];
            
            return view('buyer.payment.show', $data);
        }

        session()->flash('error', 'Cant find transaction');

        return redirect()->back();
    }

    public function update(Request $request, $uuid)
    {
        try {
            // pending_validate_request : PaymentController

            DB::beginTransaction();

            $order = auth()->user()->orders()->where('uuid', $uuid)->first();

            if (!$order) {

                session()->flash('error', 'Cant find transaction');
    
                return redirect()->back();
            }

            if ($order->payments()->whereIn('state', ['in_review','approved'])->first()) {
    
                session()->flash('warning', 'The payment has already been made.');

                return redirect('/account');
            }

            $order->update([
                'state' => 'payment_submitted'
            ]);

            $file_path = upload($order->payments(), $request->proof_file_path, $order->uuid, 'payment-buyer', true);

            $order->payments()->create([
                'user_id' => auth()->user()->id,
                'amount_submitted' => $request->amount_submitted,
                'bank_name' => $request->amount_submitted,
                'bank_account_name' => $request->bank_account_name,
                'bank_account_number' => $request->bank_account_number,
                'proof_file_path' => $file_path,
                'remarks' => $request->remarks,
                'paid_at' => now(),
                'state' => 'in_review',
            ]);

            session()->flash('success', 'Payment has been submitted.');

            DB::commit();

            return redirect('/account');

        } catch (Exception $e) {

            DB::rollback();
            
            session()->flash('error',
                $e->getMessage()
            );

            return redirect('/account');
        }
    }
}
