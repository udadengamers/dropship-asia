<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentBuyer;
use App\Models\Order;
use DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            if (request()->get('tab') == 'approved') {
                $data = PaymentBuyer::with(['order','user'])->where('state', 'approved');
            } else if (request()->get('tab') == 'rejected') {
                $data = PaymentBuyer::with(['order','user'])->where('state', 'rejected');
            } else if (request()->get('tab') == 'in_review') {
                $data = PaymentBuyer::with(['order','user'])->where('state', 'in_review');
            } else {
                $data = PaymentBuyer::with(['order','user']);
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row) {
                        return $row->created_at->format('D, d M Y H:i');
                    })
                    ->editColumn('amount_submitted', function($row) {
                        return number_format($row->amount_submitted);
                    })
                    ->editColumn('state', function($row) {
                        return $row->states[$row->state] ?? $row->state;
                    })
                    ->addColumn('user_name', function($row) {
                        $username = $row->user->fname . ' ' . $row->user->lname;
                        return $username;
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="'. route('administrator.order-payment.show', $row->uuid).'" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administrator.payment.order.index');
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
        $data ['payment'] = PaymentBuyer::where('uuid', $uuid)->firstOrFail();

        return view('administrator.payment.order.show', $data);
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

            $payment = PaymentBuyer::where('uuid', $uuid)->firstOrFail();
            
            $payment->update([
                'state' => $request->btn
            ]);

            session()->flash('success', 'Payment has been updated.');

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
