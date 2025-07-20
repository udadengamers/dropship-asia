<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Wallet;
use App\Models\Bonus;

class OrderObserver
{
    /**
     * Handle the Order "creating" event.
     *
     * @param  \App\Models\Order  $model
     * @return void
     */
    public function creating(Order $model)
    {
        $model->state = 'created';
    }

    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $model
     * @return void
     */
    public function created(Order $model)
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $model
     * @return void
     */
    public function updating(Order $model)
    {
        if ($model->isDirty('state')) {
            
            if ($model->state == 'preparing_for_shipment') {
                Wallet::create([
                    'parent_id' => $model->shop->user->id,
                    'description' => 'Order has been confirmed.',
                    'amount_in' => 0,
                    'amount_out' => $model->total,
                    'detailable_id' => $model->id,
                    'detailable_type' => get_class($model),
                    'type' => 'sales'
                ]);
            }
            
            if ($model->state == 'shipping') {
                $model->shipping_date = now();
                $model->shipping_number = request()->shipping_number;
            }
            
            if ($model->state == 'received') {
                
                Wallet::create([
                    'parent_id' => $model->shop->user->id,
                    'description' => 'Order has been received.',
                    'amount_in' => $model->total,
                    'amount_out' => 0,
                    'detailable_id' => $model->id,
                    'detailable_type' => get_class($model),
                    'type' => 'sales'
                ]);

                Bonus::create([
                    'parent_id' => $model->shop->user->id,
                    'order_id' => $model->id,
                    'bonus_percentage' => 15 ,
                    'bonus_amount' => 0.15 * $model->total,
                ]);
            }
            
            if ($model->state == 'cancelled') {

                foreach ($model->order_items as $key => $order_item) {
                        
                    if ($order_item->stock) {

                        $quantity = $order_item->stock->quantity + $order_item->quantity ;
                        
                        $order_item->stock->update([
                            'quantity' => $quantity
                        ]);

                        $quantity = 0;
                    }
                }
            }
        }
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $model
     * @return void
     */
    public function updated(Order $model)
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $model
     * @return void
     */
    public function deleted(Order $model)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $model
     * @return void
     */
    public function restored(Order $model)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $model
     * @return void
     */
    public function forceDeleted(Order $model)
    {
        //
    }
}
