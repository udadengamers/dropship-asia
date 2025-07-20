<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topup;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopupController extends Controller
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
                $data = Topup::with(['user.shop'])->where('state', 'approved');
            } else if (request()->get('tab') == 'rejected') {
                $data = Topup::with(['user.shop'])->where('state', 'rejected');
            } else if (request()->get('tab') == 'in_review') {
                $data = Topup::with(['user.shop'])->where('state', 'in_review');
            } else {
                $data = Topup::with(['user.shop']);
            }
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function($row) {
                        return $row->created_at->format('D, d M Y H:i');
                    })
                    ->editColumn('amount_submitted', function($row) {
                        return '$ ' . number_format($row->amount_submitted);
                    })
                    ->editColumn('state', function($row) {
                        return $row->states[$row->state] ?? $row->state;
                    })
                    ->addColumn('user_name', function($row) {
                        $username = $row->user->fname . ' ' . $row->user->lname;
                        return $username;
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="'. route('administrator.topup.show', $row->uuid).'" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('administrator.payment.topup.index');
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
        $data ['topup'] = Topup::where('uuid', $uuid)->firstOrFail();

        return view('administrator.payment.topup.show', $data);
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
            
            $topup = Topup::where('uuid', $uuid)->firstOrFail();
            
            $topup->update([
                'state' => $request->btn
            ]);

            session()->flash('success', 'Topup has been ' . $request->btn);

            DB::commit();

            return redirect()->route('administrator.topup.index');

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
