<?php

namespace App\Traits;
use App\Models\Wallet;

trait Order 
{
    public function wallet($order, $request, $user)
    {
        if (in_array($order->state,['created'])) {
            if (in_array($request->payment_type,['sp'])) {
                if ($user->balance >= $order->total) {
                    $order->update([
                        'state' => 'approved',
                    ]);
                    $order->payments()->create([
                        'user_id' => $user->id,
                        'amount_submitted' => $order->total,
                        'bank_name' => 'TRC 20',
                        'bank_account_name' => $user->fname ? $user->fname : ($user->account_id ? $user->email : $user->phone),
                        'bank_account_number' => $user->wallet_address,
                        'paid_at' => now(),
                        'state' => 'approved',
                        'type' => 'wallet'
                    ]);
                    $user->wallets()->create([
                        'description' => 'Order has been paid.',
                        'amount_in' => 0,
                        'amount_out' => $order->total,
                        'detailable_id' => $order->id,
                        'detailable_type' => get_class($order),
                        'type' => 'purchase'
                    ]);
                    return 'success';
                }
                return 'not_enough';
            }
        }
        return null;
    }
}
