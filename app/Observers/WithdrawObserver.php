<?php

namespace App\Observers;

use App\Models\Withdraw;
use App\Models\Wallet;

class WithdrawObserver
{
    /**
     * Handle the Withdraw "created" event.
     *
     * @param  \App\Models\Withdraw  $model
     * @return void
     */
    public function created(Withdraw $model)
    {
        //
    }

    /**
     * Handle the Withdraw "updated" event.
     *
     * @param  \App\Models\Withdraw  $model
     * @return void
     */
    public function updated(Withdraw $model)
    {
        if ($model->isDirty('state')) {
            
            if ($model->state == 'approved') {
                Wallet::create([
                    'parent_id' => $model->parent_id,
                    'description' => 'Withdraw has been approved by ' . auth()->user()->name,
                    'amount_in' => 0,
                    'amount_out' => $model->amount_submitted,
                    'detailable_id' => $model->id,
                    'detailable_type' => get_class($model),
                ]);
            }
        }
    }

    /**
     * Handle the Withdraw "deleted" event.
     *
     * @param  \App\Models\Withdraw  $model
     * @return void
     */
    public function deleted(Withdraw $model)
    {
        //
    }

    /**
     * Handle the Withdraw "restored" event.
     *
     * @param  \App\Models\Withdraw  $model
     * @return void
     */
    public function restored(Withdraw $model)
    {
        //
    }

    /**
     * Handle the Withdraw "force deleted" event.
     *
     * @param  \App\Models\Withdraw  $model
     * @return void
     */
    public function forceDeleted(Withdraw $model)
    {
        //
    }
}
