<?php

namespace App\Observers;

use App\Models\Bonus;
use App\Models\Wallet;

class BonusObserver
{
    /**
     * Handle the Order "creating" event.
     *
     * @param  \App\Models\Order  $model
     * @return void
     */
    public function created(Bonus $model)
    {
        Wallet::create([
            'parent_id' => $model->parent_id,
            'description' => 'Bonus Sales.',
            'amount_in' => $model->bonus_amount,
            'amount_out' => 0,
            'detailable_id' => $model->id,
            'detailable_type' => get_class($model),
        ]);
    }
}
