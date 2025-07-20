<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\ProductShop;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BuyerDetail;
use App\Models\Category;
use App\Models\Shipment;
use App\Models\ProductView;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuyerController extends Controller
{
    public function index()
    {
        $products = ProductView::added()->active()->where('shop_state', 'active');

        if (request('search')) {
            $products->where('name', 'like', '%' . request('search') . '%');
        }

        if (request()->ajax()) {

            $data = $products->orderByDesc('order')->paginate(20);

            $view = view('buyer.home.item', ['products' => $data])->render();

            return response()->json(['html' => $view]);
        }

        $data = $products->orderByDesc('order')->paginate(20);

        return view('home', [
            "title" => "Home",
            "user" => auth()->user(),
            "products" => $data,
        ]);
    }

    public function category()
    {
        $products = ProductView::added()->active()->where('shop_state', 'active');

        if (request()->has('tab')) {

            $category = request()->get('tab');

            $products->where('slug', $category);
        }

        if (request()->ajax()) {

            $data = $products->orderByDesc('order')->paginate(20);

            $view = view('buyer.product.item-category', ['products' => $data])->render();

            return response()->json(['html' => $view]);
        }

        $data = $products->orderByDesc('order')->paginate(20);

        return view('buyer.product.category', [
            "title" => "category",
            "products" => $data,
            "categories" => Category::get(),
        ]);
    }

    public function cart()
    {
        $user_id = auth()->user()->id;

        $shops = Shop::with(['carts' => function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        }])->whereHas('carts', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->ActiveShop();

        // if (request()->ajax()) {

        //     $data = $shops->paginate(5);

        //     $view = view('buyer.order.item_cart', ['shops' => $data])->render();

        //     return response()->json(['html' => $view]);
        // }

        // $crt = Cart::where('user_id', auth()->user()->id)->active()->get();

        return view('buyer.order.cart', [
            "title" => "Cart",
            // "carts" => $crt,
            "shops" => $shops->get(),
            'shipments' => Shipment::get(),
        ]);
    }

    public function mall()
    {
        $shops = Shop::query()->ActiveShop();

        if (request()->ajax()) {

            $data = $shops->paginate(5);

            $view = view('buyer.product.item-mall', ['shops' => $data])->render();

            return response()->json(['html' => $view]);
        }

        return view('buyer.product.mall', [
            "title" => "Mall",
            'shops' => $shops->paginate(5),
        ]);
    }

    public function account()
    {
        $order = Order::where('user_id', auth()->user()->id);
        // dd($order);
        $orderslug = "";
        if (request()->has('tab')) {

            $orderslug = request()->get('tab');
            if ($orderslug == "payment") {
                $order->whereIn('state', ['approved', 'created', 'payment_submitted']);
            } else if ($orderslug == "shipping") {
                $order->whereIn('state', ['preparing_for_shipment', 'shipping']);
            } else if ($orderslug == "completed") {
                $order->whereIn('state', ['received', 'completed']);
            }
        }

        if (request()->ajax()) {

            $data = $order->orderByDesc('created_at')->paginate(5);
            // Log::info($data);
            $view = view('buyer.order.item-order', [
                'orders' => $data,
            ])->render();

            return response()->json(['html' => $view]);
        }
        // dd(auth()->user()->id);

        $data = $order->orderByDesc('created_at')->paginate(5);
        // Log::info($data);
        return view('buyer.profile.account', [
            "title" => "Account",
            'orders' => $data,
            'orderslug' => $orderslug,
            'badgecs' => Service::where('user_id', auth()->user()->id)->whereNull('state')->get(),
        ]);
    }

    public function shop($shop)
    {
        $shop = Shop::where('slug', $shop)->firstOrFail();

        $shop_id = $shop->id;

        $best_products = OrderItem::select(DB::raw('SUM(quantity) as count', 'product_id'), 'product_id')
            ->whereHas('order', function ($query) use ($shop_id) {
                $query->where('shop_id', $shop_id);
                $query->where('state', 'received');
            })->groupBy('product_id')->orderBy('count', 'DESC')->get();


        $shop_products = $shop->shop_products()->added()->productActive()->get();

        return view('buyer.shop.shop-detail', [
            'title' => $shop->name,
            'shop' => $shop,
            'best_products' => $best_products,
            'shop_products' => $shop_products,
        ]);
    }

    public function shopdetail($uuid)
    {
        $shop = Shop::where('uuid', $uuid)->firstOrFail();

        $shop_id = $shop->id;

        $bestproduct = OrderItem::select(DB::raw('SUM(quantity) as count', 'product_id'), 'product_id')
            ->whereHas('order', function ($query) use ($shop_id) {
                $query->where('shop_id', $shop_id);
                $query->where('state', 'received');
            })->groupBy('product_id')->orderBy('count', 'DESC')->get();


        $shop_products = $shop->shop_products()->added()->productActive()->get();

        return view('buyer.shop.shop-detail', [
            'title' => Shop::where('uuid', $uuid)->first()->name,
            'shop' => Shop::where('uuid', $uuid)->first(),
            'best_products' => $bestproduct,
            'shop_products' => $shop_products,
        ]);
    }
}
