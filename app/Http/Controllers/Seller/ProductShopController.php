<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('seller.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $data['product'] = Product::where('uuid', $uuid)->active()->firstOrFail();

        return view('seller.product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $product = Product::where('uuid', $uuid)->active()->firstOrFail();

            if (($product->stocks->count() > 0) && ($product->stocks->first()->quantity < 1)) {

                session()->flash('warning', 'We`re sorry, but the product you are looking for is currently out of stock.');

                return redirect()->back();
            }

            $user = auth()->user();

            $shop = $user->shop;

            $product_shop = $shop->shop_products()->where('product_id', $product->id)->first();

            if ($product_shop) {

                if (in_array($product_shop->state, ['removed'])) {

                    $product_shop->update([
                        'state' => 'added',
                    ]);

                    session()->flash('success', 'Product has been added.');

                    DB::commit();

                    return redirect()->back();
                }

                session()->flash('warning', 'Product already in shop.');

                return redirect()->back();
            }

            $shop->shop_products()->create([
                'state' => 'added',
                'product_id' => $product->id,
            ]);

            session()->flash('success', 'Product has been added.');

            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try {
            DB::beginTransaction();

            $product = Product::where('uuid', $uuid)->firstOrFail();

            $user = auth()->user();

            $shop = $user->shop;

            $product_shop = $shop->shop_products()->where('product_id', $product->id)->firstOrFail();

            if ($product_shop) {

                if (in_array($product_shop->state, ['removed'])) {

                    session()->flash('warning', 'Product not found. It may have been removed from your shop.');

                    return redirect()->back();
                }
            }

            $product_shop->update([
                'state' => 'removed',
            ]);

            session()->flash('success', 'Product has been removed.');

            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }
}
