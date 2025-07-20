<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVIewSeeder extends Seeder
{
    private function createView(): string
    {
        return "
            CREATE OR REPLACE VIEW `product_views` AS

            SELECT
                product_shops.id AS product_shop_id,
                product_shops.state AS product_shop_state,
                product_shops.created_at AS product_shop_created_at,
                products.id AS id,
                shops.id AS shop_id,
                products.uuid AS uuid,
                products.name,
                products.sku AS product_sku,
                products.description,
                products.is_variation,
                products.state,
                products.category_id,
                products.created_at,
                categories.name AS category_name,
                categories.slug,
                FLOOR(RAND() * POWER(10, 10)) + product_shops.id AS `order`,
                shops.state as shop_state
            FROM
                product_shops
            INNER JOIN
                products ON (
                    products.id = product_shops.product_id
                )
            INNER JOIN
                shops ON (
                    shops.id = product_shops.shop_id
                )
            INNER JOIN
                categories ON (
                    categories.id = products.category_id
                )
            ;
        ";
    }

    private function dropView(): string
    {
        return "DROP VIEW IF EXISTS `product_views`;";
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement($this->dropView());
        DB::statement($this->createView());
    }
}
