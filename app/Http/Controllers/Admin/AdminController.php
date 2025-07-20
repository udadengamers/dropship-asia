<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            if (request()->get('tab') == 'active') {
                $data = Admin::nonSuper()->active();
            } else if (request()->get('tab') == 'inactive') {
                $data = Admin::nonSuper()->where('state', 'inactive');
            } else {
                $data = Admin::nonSuper();
            }
            $data->orderByDesc('id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $data['admin'] = $row;
                    return view('administrator.admin.table.action', $data);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('administrator.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['admin'] = new Admin();

        return view('administrator.admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // validation

            DB::beginTransaction();

            $data = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|unique:admins',
                'password' => 'required',
                'wallet_address' => 'required',
                'state' => 'required',
            ]);

            $data['password'] = Hash::make($data['password']);

            $data['remember_token'] = Str::random(10);

            $admin = Admin::create($data);

            session()->flash('success', 'Admin has been created.');

            DB::commit();

            return redirect()->back();
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
    public function edit($uuid)
    {
        $admin = Admin::where('uuid', $uuid)->firstOrFail();

        $data['admin'] = $admin;

        return view('administrator.admin.edit', $data);
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
            // validation

            $admin = Admin::where('uuid', $uuid)->firstOrFail();

            DB::beginTransaction();

            $data = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|unique:admins,id,' . $admin->id,
                'wallet_address' => 'required',
                'state' => 'required',
            ]);

            $admin->update($data);

            session()->flash('success', 'Admin has been updated.');

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
