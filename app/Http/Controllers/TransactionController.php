<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Shipment;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Traits\Order as OrderTraits;

class TransactionController extends Controller
{
    use OrderTraits;

    public function transactionview()
    {
        // dd(auth()->user()->id);
        $order = Order::where('user_id', auth()->user()->id);
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
        $data = $order->orderByDesc('created_at')->paginate(5);
        // dd($data);
        return view('buyer.order.transaction', [
            'title' => 'My Transaction',
            'orders' => $data,
        ]);
    }

    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();

            $shipment = Shipment::where('id', $request['shipment_id'])->first();

            if (!$shipment) {

                return response()->json([
                    'message' => 'We apologize, the cargo you chose is no longer available as it was removed by our administrator.',
                ], 404);
            }

            foreach ($request['cartArray'] as $shop) {

                $data = ([
                    'user_id' => $shop['user_id'],
                    'shop_id' => $shop['shop_id'],
                    'order_date' => now(),
                    'shipment_id' => $request['shipment_id'],
                    'note' => $shop['note'],
                    'shipping_name' => $shipment->name,
                    'shipping_price' => $shipment->price,
                    'total' => $shop['total'] + $request['shipment_price'],
                ]);

                $order = Order::create($data);

                $wallet = $this->wallet($order, $request, auth()->user());

                if ($wallet) {
                    if ($wallet == 'not_enough') {
                        DB::rollback();
                        return response()->json([
                            'message' => false,
                            'description' => 'Your account balance is not enough. Please top up.',
                        ], 402);
                    }
                }

                $cartItem = Cart::where("user_id", auth()->user()->id)->where("shop_id", $order['shop_id'])->get();

                foreach ($cartItem as $ci) {

                    $stock = Stock::where('id', $ci->stock_id)->first();

                    if ($stock) {

                        OrderItem::create([
                            'product_id' => $ci['product_id'],
                            'order_id' => $order->id,
                            'stock_id' => $ci->stock_id,
                            'quantity' => $ci->quantity,
                            'stock_name' => $stock->name,
                            'stock_price' => $stock->price,
                            'sub_total' => ($ci->quantity) * ($ci->stock->price),
                        ]);

                        $stock->update([
                            'quantity' => $stock->quantity - $ci->quantity
                        ]);
                    }
                }
                Cart::where('shop_id', $shop['shop_id'])
                    ->where('user_id', auth()->user()->id)
                    ->delete();
            }

            DB::commit();

            return response()->json([
                'message' => 'success',
                // 'shop_data' => $request['cartArray'],
                // 'shipment_id' => $request['shipment_id'],
                // 'shipment_price' => $request['shipment_price'],
            ], 201);
        } catch (Exception $e) {

            DB::rollback();

            Log::info($e);

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }
    public function transdetail($order_id)
    {
        // dd(OrderItem::where('order_id', $order_id)->get());
        return view('buyer.order.trs-detail', [
            'title' => 'My Transaction Detail',
            'order_items' => OrderItem::where('order_id', $order_id)->get(),
        ]);
    }
    public function checkoutbuynow(Request $request)
    {
        try {
            DB::beginTransaction();

            $stock = Stock::where('id', $request['stock_id'])->first();

            if (!$stock) {
                return redirect()->back()->with('danger', 'We apologize, but the product you wanted to buy is no longer available.');
            }

            $shipment = Shipment::where('id', $request['shipment_id'])->first();

            if (!$shipment) {
                return redirect()->back()->with('danger', 'We apologize, the cargo you chose is no longer available as it was removed by our administrator.');
            }

            $data = ([
                'user_id' => auth()->user()->id,
                'shop_id' => $request['shop_id'],
                'shipment_id' => $request['shipment_id'],
                'note' => $request['note'],
                'total' => (($request->quantity) * ($stock->price)) + ($shipment->price),
                'order_date' => now(),
                'shipping_name' => $shipment->name,
                'shipping_price' => $shipment->price,
            ]);

            $order = Order::create($data);

            $wallet = $this->wallet($order, $request, auth()->user());

            if ($wallet) {
                if ($wallet == 'not_enough') {
                    DB::rollback();
                    session()->flash('error', 'Your account balance is not enough. Please top up.');
                    return redirect()->back();
                }
            }

            OrderItem::create([
                'product_id' => $request['product_id'],
                'order_id' => $order->id,
                'stock_id' => $request->stock_id,
                'quantity' => $request->quantity,
                'stock_name' => $stock->name,
                'stock_price' => $stock->price,
                'sub_total' => ($request->quantity) * ($stock->price),
            ]);

            DB::commit();

            return redirect('/my-transaction')->with('success', 'success checkout');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }

    public function received(Request $request, $uuid)
    {
        try {
            // pending_validate_request : PaymentController

            DB::beginTransaction();

            $order = auth()->user()->orders()->where('uuid', $uuid)->firstOrFail();

            $order->update([
                'state' => 'received'
            ]);

            session()->flash('success', 'Item has been received.');

            DB::commit();

            return redirect('/account');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash(
                'error',
                $e->getMessage()
            );

            return redirect('/account');
        }
    }

    public function cancelled(Request $request, $uuid)
    {
        try {
            // pending_validate_request : PaymentController

            DB::beginTransaction();

            $order = auth()->user()->orders()->where('uuid', $uuid)->firstOrFail();

            $order->update([
                'state' => 'cancelled'
            ]);

            session()->flash('success', 'Transaction has been canceled.');

            DB::commit();

            return redirect('/account');
        } catch (Exception $e) {

            DB::rollback();

            session()->flash(
                'error',
                $e->getMessage()
            );

            return redirect('/account');
        }
    }
}
