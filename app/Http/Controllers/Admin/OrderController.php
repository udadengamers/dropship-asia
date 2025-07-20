<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            if (request()->get('tab') == 'pending_payment') {
                $data = Order::with(['user', 'shop'])->where('state', 'created');
            } else if (request()->get('tab') == 'payment_submitted') {
                $data = Order::with(['user', 'shop'])->where('state', 'payment_submitted');
            } else if (request()->get('tab') == 'approved_payment') {
                $data = Order::with(['user', 'shop'])->where('state', 'approved');
            } else if (request()->get('tab') == 'seller_response') {
                $data = Order::with(['user', 'shop'])->where('state', 'preparing_for_shipment');
            } else if (request()->get('tab') == 'shipped') {
                $data = Order::with(['user', 'shop'])->where('state', 'shipping');
            } else if (request()->get('tab') == 'received') {
                $data = Order::with(['user', 'shop'])->where('state', 'received');
            } else if (request()->get('tab') == 'cancelled') {
                $data = Order::with(['user', 'shop'])->where('state', 'cancelled');
            } else {
                $data = Order::with(['user', 'shop']);
            }

            $data->orderByDesc('id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('order_date', function ($row) {
                    return $row->order_date->format('D, d M Y H:i');
                })
                ->editColumn('total', function ($row) {
                    return '$ ' . number_format($row->total);
                })
                ->editColumn('state', function ($row) {
                    return $row->states[$row->state] ?? $row->state;
                })
                ->addColumn('shop.name', function ($row) {
                    $data['order'] = $row;
                    $data['type'] = 'shop';
                    return view('administrator.order.table.contact_person', $data);
                })
                ->addColumn('user_name', function ($row) {
                    // $username = $row->user->fname . ' ' . $row->user->lname;
                    // return $username;
                    $data['order'] = $row;
                    $data['type'] = 'buyer';
                    return view('administrator.order.table.contact_person', $data);
                })
                ->addColumn('action', function ($row) {
                    $data['order'] = $row;
                    $data['payment'] = $row->payments()->latest()->first();
                    return view('administrator.order.table.action', $data);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('administrator.order.index');
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
        $order = Order::where('uuid', $uuid)->with(['user', 'order_items.product', 'order_items.stock', 'shop', 'payments'])->firstOrFail();

        $data['order'] = $order;

        $data['payment'] = $order->payments()->latest()->first();

        return view('administrator.order.show', $data);
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

            $order = Order::where('uuid', $uuid)->firstOrFail();

            $order->update([
                'state' => $request->btn
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
}
