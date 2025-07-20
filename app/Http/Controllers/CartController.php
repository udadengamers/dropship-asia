<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Shop;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Exception;

class CartController extends Controller
{
    public function addtocart(Request $request)
    {
        try {
            DB::beginTransaction();

            //cek seller jika ada
            //cek shop jika ada


            $data = ([
                'user_id' => auth()->user()->id,
                'stock_id' => $request['stock_id'],
                'shop_id' => $request['shop_id'],
                'product_id' => $request['product_id'],
                'quantity' => $request['quantity'],

            ]);

            $exists = Cart::where('product_id', $data['product_id'])
                ->where('shop_id', $data['shop_id'])
                ->where('user_id', $data['user_id'])
                ->where('stock_id', $data['stock_id'])
                ->exists();
            $existsData = Cart::where('product_id', $data['product_id'])
                ->where('shop_id', $data['shop_id'])
                ->where('user_id', $data['user_id'])
                ->where('stock_id', $data['stock_id'])->first();
            // dd($existsData);
            $cekStock = Stock::where('id', $request['stock_id'])->first();
            if ($cekStock->quantity == 1 && $existsData['quantity'] >= 1) {
                return redirect()->back()->with('error', 'Stock quantity has reach out, cannot add more to cart');
            }

            if ($exists) {
                $oldQ = Cart::where('product_id', $data['product_id'])
                    ->where('shop_id', $data['shop_id'])
                    ->where('user_id', $data['user_id'])
                    ->where('stock_id', $data['stock_id'])
                    ->first()->quantity;
                $newQ = $request['quantity'] + $oldQ;
                Cart::where('product_id', $data['product_id'])
                    ->where('shop_id', $data['shop_id'])
                    ->where('user_id', $data['user_id'])
                    ->where('stock_id', $data['stock_id'])
                    ->update(['quantity' => $newQ]);
            } else {
                Cart::create($data);
            }

            DB::commit();

            return redirect()->back()->with('success', 'product successful added to cart');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }

    public function updateqtycart(Request $request)
    {
        $cart_id = $request['cart_id'];
        $data = ([
            'quantity' => $request['quantity'],
        ]);

        $cart = Cart::where('id', $cart_id)->update($data);
        return response()->json([
            'message' => 'success',
        ], 200);
    }

    public function deletecart($id)
    {
        try {
            DB::beginTransaction();

            $cart_id = $id;
            Cart::where('id', $cart_id)->delete();


            DB::commit();

            return redirect()->back()->with('success', 'Product berhasil dihapus dari Keranjang');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }
}
