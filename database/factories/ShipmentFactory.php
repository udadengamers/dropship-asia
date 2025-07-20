<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name' => 'Instant Shipment',
            'description' => 'instant sending in same day',
            'price' => '4',
        ];
    }

    public function cargo()
    {
        return $this->state([
            'name' => 'Cargo',
            'description' => '2-3 day in sending progress',
            'price' => '2',
        ]);
    }

    public function standard()
    {
        return $this->state([
            'name' => 'Standard',
            'description' => '2-5 day in sending progress',
            'price' => '1',
        ]);
    }
}
