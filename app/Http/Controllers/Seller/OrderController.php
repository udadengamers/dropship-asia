<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    public function index()
    {
        // if (request()->ajax()) {
        //     $data = auth()->user()->shop->orders()->with(['order_items', 'user']);
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->editColumn('order_date', function ($row) {
        //             return $row->order_date->format('D, d M Y H:i');
        //         })
        //         ->editColumn('total', function ($row) {
        //             return number_format($row->total);
        //         })
        //         ->editColumn('state', function ($row) {
        //             return $row->states[$row->state] ?? $row->state;
        //         })
        //         ->addColumn('user_name', function ($row) {
        //             $username = $row->user->fname . ' ' . $row->user->lname;
        //             return $username;
        //         })
        //         ->addColumn('action', function ($row) {
        //             $data['order'] = $row;
        //             return view('seller.order.table.action', $data);
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
        $order = auth()->user()->shop->orders()->with(['order_items', 'user']);

        if (request()->get('tab') == 'pending_payment') {
            $order->where('state', 'created');
        } else if (request()->get('tab') == 'payment_submitted') {
            $order->where('state', 'payment_submitted');
        } else if (request()->get('tab') == 'approved_payment') {
            $order->where('state', 'approved');
        } else if (request()->get('tab') == 'seller_response') {
            $order->where('state', 'preparing_for_shipment');
        } else if (request()->get('tab') == 'shipped') {
            $order->where('state', 'shipping');
        } else if (request()->get('tab') == 'received') {
            $order->where('state', 'received');
        } else if (request()->get('tab') == 'cancelled') {
            $order->where('state', 'cancelled');
        } else {
            $order;
        }

        if (request()->has('order_search')) {

            $keyword = request()->get('order_search');

            $order->whereHas('order_items', function ($query) use ($keyword) {
                $query->whereHas('product', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")->orWhere('description', 'LIKE', "%{$keyword}%");
                });
            });
        }

        if (request()->ajax()) {

            $view = view('seller.order.parts.item', ['orders' => $order->orderByDesc('id')->paginate(1)])->render();

            return response()->json(['html' => $view]);
        }

        $data['orders'] = $order->orderByDesc('id')->paginate(1);

        return view('seller.order.index', $data);
    }

    public function update(Request $request, $uuid)
    {
        try {
            DB::beginTransaction();

            $order = auth()->user()->shop->orders()->where('uuid', $uuid)->firstOrFail();

            $balance = auth()->user()->balance;

            if ($balance <= $order->total) {

                session()->flash('warning', 'Balance is not enough. Please <a href="' . route('seller.topup.index') . '">top-up</a> and try again.');

                return redirect()->back();
            }

            $order->update([
                'state' => $request->new_state
            ]);

            session()->flash('success', 'Order has been updated.');

            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }

    public function show($uuid)
    {
        $order = auth()->user()->shop->orders()->where('uuid', $uuid)->firstOrFail();

        $data['order'] = $order;

        $data['payment'] = $order->payments()->latest()->first();

        return view('seller.order.show', $data);
    }
}
