<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductShop;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\Shipment;
use App\Models\Category;

class ProductController extends Controller
{
    public function productdetailindex()
    {
        $product_id = request('product_id');
        $shop_id = request('shop_id');
        $product = Product::where('id', $product_id)->active()->firstOrfail();
        // @dd(Product::find($product_id), Shop::find($shop_id));
        // @dd(Stock::where('product_id', $product_id)->get());
        return view('buyer.product.product-detail', [
            'title' => 'detail',
            'product' => $product,
            'shop' => Shop::find($shop_id),
            'stocks' => Stock::where('product_id', $product_id)->get(),
            'shipments' => Shipment::get(),
        ]);
    }
    public function productcateg()
    {
        $categ_id = request('categ_id');
        return view('buyer.product.category', [
            "title" => "category",
            "products" => ProductShop::inRandomOrder()->get(),
            "categories" => Category::get(),
        ]);
    }
}
