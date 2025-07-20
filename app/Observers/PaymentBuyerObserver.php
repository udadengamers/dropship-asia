<?php

namespace App\Observers;

use App\Models\PaymentBuyer;

class PaymentBuyerObserver
{
    /**
     * Handle the PaymentBuyer "created" event.
     *
     * @param  \App\Models\PaymentBuyer  $model
     * @return void
     */
    public function created(PaymentBuyer $model)
    {
        //
    }

    /**
     * Handle the PaymentBuyer "updating" event.
     *
     * @param  \App\Models\PaymentBuyer  $model
     * @return void
     */
    public function updating(PaymentBuyer $model)
    {
        if ($model->isDirty('state')) {
            
            if ($model->state == 'approved') {

                $model->approved_by_id = auth()->user()->id;

                $model->approved_at = now();
            }
        }
    }

    /**
     * Handle the PaymentBuyer "updated" event.
     *
     * @param  \App\Models\PaymentBuyer  $model
     * @return void
     */
    public function updated(PaymentBuyer $model)
    {
        if ($model->isDirty('state')) {
            
            if ($model->state == 'approved') {
                
                $model->order->update([
                    'state' => 'approved'
                ]);

                // $order = $model->order;

                // if ($order) {
                    
                //     foreach ($order->order_items as $key => $order_item) {
                        
                //         if ($order_item->stock) {

                //             $quantity = $order_item->stock->quantity - $order_item->quantity ;
                            
                //             $order_item->stock->update([
                //                 'quantity' => $quantity
                //             ]);

                //             $quantity = 0;
                //         }
                //     }
                // }
            }

            if ($model->state == 'rejected') {                
                $model->order->update([
                    'state' => 'payment_rejected'
                ]);
            }
        }
    }

    /**
     * Handle the PaymentBuyer "deleted" event.
     *
     * @param  \App\Models\PaymentBuyer  $model
     * @return void
     */
    public function deleted(PaymentBuyer $model)
    {
        //
    }

    /**
     * Handle the PaymentBuyer "restored" event.
     *
     * @param  \App\Models\PaymentBuyer  $model
     * @return void
     */
    public function restored(PaymentBuyer $model)
    {
        //
    }

    /**
     * Handle the PaymentBuyer "force deleted" event.
     *
     * @param  \App\Models\PaymentBuyer  $model
     * @return void
     */
    public function forceDeleted(PaymentBuyer $model)
    {
        //
    }
}
