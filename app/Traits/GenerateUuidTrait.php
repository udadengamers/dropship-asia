<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateUuidTrait 
{
    protected static function bootGenerateUuidTrait() 
    {
        static::creating(function($model) 
        {
            $model->uuid = (String) Str::uuid();
        });

    }

    public function uuid()
    {
        return (String) Str::uuid();
    }
}
