<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use DataTables;

class LogsController extends Controller
{
    public function index()
    {
        $result = null;

        $path = storage_path('logs');

        $files = File::allFiles($path);
        
        foreach($files as $file) { 
            $result[] = pathinfo($file);
        }

        $data['logs'] = $result;

        if (request()->ajax()) {
            $collection = collect($result);
            return Datatables::of($collection)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $data ['log'] = $row;
                        return view('administrator.logs.table.action', $data);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('administrator.logs.index', $data);
    }

    public function download(Request $request)
    {
        return response()->download($request->dirname . '/' . $request->basename);
    }
}
