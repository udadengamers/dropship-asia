<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $file = new Filesystem;
        // delete
        $file->cleanDirectory('storage/app/public/payment-buyer');
        $file->cleanDirectory('storage/app/public/top-up');
        $file->cleanDirectory('storage/app/public/product');
        $file->cleanDirectory('storage/app/public/withdraw');
        $file->cleanDirectory('storage/app/public/shop');
        // user
        \App\Models\User::factory(10)->create();
        \App\Models\Admin::factory(10)->create();
        $this->call(SellerSeeder::class);
        $this->call(AdminSeeder::class);
        // category
        $this->call(CategorySeeder::class);
        // product
        $this->call(ProductSeeder::class);
        // synchronization
        $this->call(SellerShopSeeder::class);
        $this->call(SynProductShopSeeder::class);
        // shipment
        $this->call(ShipmentSeeder::class);
    }
}
