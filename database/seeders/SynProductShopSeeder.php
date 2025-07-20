<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Shop;

class SynProductShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::get();

        $sellers = User::seller()->get();

        $shops = Shop::get();

        $total = $products->count();
        
        $numbers = array();

        for ($i = 0; $i < $sellers->count(); $i++) {
            $sub_elements = array();
            $num_sub_elements = rand(1, $total);
            for ($j = 0; $j < $num_sub_elements; $j++) {
                $sub_elements[] = rand(1, $total);
            }
            $numbers[$sellers[$i]->id] = $sub_elements;
        }
        
        foreach ($numbers as $key => $number) {

            $seller = User::seller()->find($key);

            if ($seller) {

                if ($seller->shop) {

                    foreach ($number as $key => $value) {
                    
                        $product_shop = $seller->shop->shop_products()->where('product_id', $value)->first();

                        if (!$product_shop) {
                            
                            $seller->shop->shop_products()->create([
                                'state' => 'added',
                                'product_id' => $value,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
