<?php

namespace App\Traits;

use App\Exceptions\StatusValidationException;

trait StateMachineTrait
{
    /**
     * First booting
     *
     * @return void
     */
    public static function bootStateMachineTrait()
    {
        if (!property_exists(__CLASS__, 'status')) 
        {
            throw new StatusValidationException('State machine need to status properti in the class ' . __CLASS__);
        }

        static::updating(function ($model) 
        {
            if (!property_exists(__CLASS__, 'status')) 
            {
                throw new StatusValidationException('State machine need to status properti in the class ' . __CLASS__);
            }

            if ($model->isDirty('state')) 
            {
                $original = $model->getOriginal('state');
                $newState = $model->state;

                if (!in_array($newState, $model->allow_status($original))) 
                {
                    throw new StatusValidationException("The current state {$original} not allowed to change to state {$newState}");
                }
            }
        });
    }

    /**
     * Allowing status
     *
     * @param [type] $status
     * @return void
     */
    public function allow_status($status)
    {
        return $this->status[$status] ?? [];
    }

    /**
     * Listing of status
     *
     * @return void
     */
    public function getListStatusAttribute()
    {
        $status = [];
        foreach ($this->status as $state => $item) {
            $status[] = $state;
        }
        return $status;
    }
}
