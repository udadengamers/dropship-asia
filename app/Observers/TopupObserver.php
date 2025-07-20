<?php

namespace App\Observers;

use App\Models\Topup;
use App\Models\Wallet;

class TopupObserver
{
    /**
     * Handle the Topup "created" event.
     *
     * @param  \App\Models\Topup  $model
     * @return void
     */
    public function created(Topup $model)
    {
        //
    }

    /**
     * Handle the Topup "updating" event.
     *
     * @param  \App\Models\Topup  $model
     * @return void
     */
    public function updating(Topup $model)
    {
        if ($model->isDirty('state')) {
            
            if ($model->state == 'approved') {

                $model->approved_by_id = auth()->user()->id;

                $model->approved_at = now();
            }
        }
    }

    /**
     * Handle the Topup "updated" event.
     *
     * @param  \App\Models\Topup  $model
     * @return void
     */
    public function updated(Topup $model)
    {
        if ($model->isDirty('state')) {
            
            if ($model->state == 'approved') {
                Wallet::create([
                    'parent_id' => $model->parent_id,
                    'description' => 'Topup has been approved by ' . auth()->user()->name,
                    'amount_in' => $model->amount_submitted,
                    'amount_out' => 0,
                    'detailable_id' => $model->id,
                    'detailable_type' => get_class($model),
                ]);
            }
        }
    }

    /**
     * Handle the Topup "deleted" event.
     *
     * @param  \App\Models\Topup  $model
     * @return void
     */
    public function deleted(Topup $model)
    {
        //
    }

    /**
     * Handle the Topup "restored" event.
     *
     * @param  \App\Models\Topup  $model
     * @return void
     */
    public function restored(Topup $model)
    {
        //
    }

    /**
     * Handle the Topup "force deleted" event.
     *
     * @param  \App\Models\Topup  $model
     * @return void
     */
    public function forceDeleted(Topup $model)
    {
        //
    }
}
