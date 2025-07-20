<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ProductShop;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\Seller\ShopRequest;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop_id = request()->shop->id;

        $product = ProductShop::where('shop_id', $shop_id)->with('product');

        $data['oot'] = false;

        // if (request()->has('tab')) {
        //     // if (request()->tab == 'removed') {
        //     //     $product->removed();
        //     // }
        // }
        if (request()->tab == 'out_of_stock') {
            $product->whereHas('product', function ($query_product) {
                $query_product->outstock()->active();
            });
        } else {
            $product->added()->whereHas('product', function ($query_product) {
                $query_product->instock()->active();
            });
        }

        if (request()->ajax()) {
            $view = view('seller.shop.parts.item', ['product_shops' => $product->orderByDesc('updated_at')->paginate(5)])->render();

            return response()->json(['html' => $view]);
        }

        $data['product_shops'] = $product->orderByDesc('updated_at')->paginate(5);

        $data['best_products'] = OrderItem::select(DB::raw('SUM(quantity) as count', 'product_id'), 'product_id')
            ->whereHas('order', function ($query) use ($shop_id) {
                $query->where('shop_id', $shop_id);
                $query->where('state', 'received');
            })->groupBy('product_id')->orderBy('count', 'DESC')->get();

        return view('seller.shop.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->shop) {
            return redirect()->route('seller.shop.edit', auth()->user()->shop->uuid);
        }

        $data['shop'] = auth()->user()->shop ?? new Shop();

        return view('seller.shop.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShopRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = auth()->user();

            if (empty($user->type)) {
                $user->update([
                    'type' => 'seller'
                ]);
            }

            $shop = auth()->user()->shop;

            $file_path_profile_picture = upload(auth()->user()->shop(), $request->shop_profile_picture, 'profile_picture', 'shop', true);

            $file_path_business_license = null;

            if ($request->business_license) {
                $file_path_business_license = upload(auth()->user()->shop(), $request->business_license, 'business_license', 'shop', true);
            }

            $data = [
                'name' => $request->shop_name,
                'slug' => Str::slug($request->shop_name),
                'description' => $request->shop_name,
                'supplier_name' => $request->supplier_name,
                'invitation_code' => $request->invitation_code,
                'description' => $request->description,
                'phone_number' => $request->shop_phone_number,
                'contact_person' => $request->contact_person_name,
                'id_card' => $request->id_card,
                'address' => $request->shop_address,
                'payment_method_id' => $request->payment_method,
                'merchant_id' => $request->merchant_category,
                'profile_picture' => $file_path_profile_picture,
                'business_license' => $file_path_business_license,
                'type' => $request->type,
                'state' => $request->state ?? 'active',
            ];

            if ($shop) {
                auth()->user()->shop()->update($data);
            } else {
                auth()->user()->shop()->create($data);
            }

            session()->flash('success', 'Shop has been updated.');

            DB::commit();

            return redirect()->back()->with('success', 'Shop has been updated.');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['shop'] = auth()->user()->shop;

        return view('seller.shop.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShopRequest $request, $ulid)
    {
        try {

            DB::beginTransaction();

            $user = auth()->user();

            if (empty($user->type)) {
                $user->update([
                    'type' => 'seller'
                ]);
            }

            $file_path_shop_profile_picture = $request->shop->profile_picture ?? null;

            if ($request->shop_profile_picture) {
                if ($request->shop->profile_picture) {
                    $file = storage_path('app/public/' . $request->shop->profile_picture);

                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
                $file_path_shop_profile_picture = upload(auth()->user()->shop(), $request->shop_profile_picture, $request->shop->uuid . '/profile_picture', 'shop', true);
            }

            $file_path_business_license = $request->shop->business_license ?? null;

            if ($request->business_license) {
                if ($request->shop->business_license) {
                    $file = storage_path('app/public/' . $request->shop->business_license);

                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
                $file_path_business_license = upload(auth()->user()->shop(), $request->business_license, $request->shop->uuid . '/business_license', 'shop', true);
            }

            $request->shop->update([
                'name' => $request->shop_name,
                'slug' => Str::slug($request->shop_name),
                'description' => $request->shop_name,
                'supplier_name' => $request->supplier_name,
                'invitation_code' => $request->invitation_code,
                'description' => $request->description,
                'phone_number' => $request->shop_phone_number,
                'contact_person' => $request->contact_person_name,
                'id_card' => $request->id_card,
                'address' => $request->shop_address,
                'payment_method_id' => $request->payment_method,
                'merchant_id' => $request->merchant_category,
                'type' => $request->type,
                'business_license' => $file_path_business_license,
                'profile_picture' => $file_path_shop_profile_picture,
                'state' => $request->state ?? 'active',
            ]);

            session()->flash('success', 'Shop has been udpated.');

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
    public function destroy($id)
    {
        //
    }

    public function shop_edit_dummy()
    {
        if (auth()->user()->shop) {
            return redirect()->route('seller.shop.edit', auth()->user()->shop->uuid);
        }
        return redirect()->route('seller.shop.create');
    }
}
