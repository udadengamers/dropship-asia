<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateAccountIdTrait 
{
    protected static function bootGenerateAccountIdTrait() 
    {
        static::creating(function($model) 
        {
            $first = ($model->email ? substr($model->email, 0, strpos($model->email, '@')) : $model->phone );
            $last = uniqid();
            $model->account_id = $first . $last;
        });

    }
}
