<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateTrxCodeTrait 
{
    protected static function bootGenerateTrxCodeTrait() 
    {
        static::creating(function($model) 
        {
            $model->trx_code = strtoupper(class_basename($model)) . '-' . strtoupper(Str::random(4)) . time() . '-' . auth()->user()->id;
        });
    }
}
