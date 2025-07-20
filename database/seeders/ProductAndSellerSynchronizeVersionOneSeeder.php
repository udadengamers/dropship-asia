<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductAndSellerSynchronizeVersionOneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product
        $this->call(NewProduct1stSeeder::class);
        $this->call(NewProduct2ndSeeder::class);
        $this->call(NewProduct2ndV1Seeder::class);
        $this->call(NewProduct2ndV2Seeder::class);
        $this->call(NewProduct3rdSeeder::class);
        $this->call(NewProduct4thSeeder::class);
        // New Synchronize
        $this->call(SynProductShopSeeder::class);
    }
}
