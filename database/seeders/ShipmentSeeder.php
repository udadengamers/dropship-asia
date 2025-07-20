<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipment;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipment::create([
            'name' => 'Instant',
            'description' => 'instant sending in same day',
            'price' => '4',
        ]);

        Shipment::create([
            'name' => 'Cargo',
            'description' => '2-3 day in sending progress',
            'price' => '2',
        ]);

        Shipment::create([
            'name' => 'Standard',
            'description' => '2-5 day in sending progress',
            'price' => '1',
        ]);
    }
}
