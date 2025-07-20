<?php

namespace App\Observers;

class ProductImageObserver
{
    /**
     * Handle the PaymentBuyer "deleted" event.
     *
     * @param  \App\Models\PaymentBuyer  $model
     * @return void
     */
    public function deleted($model)
    {
        $file = storage_path('app/public/' .$model->path_file);

        if (file_exists($file)) {
            unlink($file);
        }
    }
}
