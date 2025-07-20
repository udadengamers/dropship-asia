<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Service;
use Illuminate\Contracts\Support\ValidatedData;

class ServiceController extends Controller
{
    public function serviceview()
    {
        Service::where('user_id', auth()->user()->id)->where('owner','admin')->update([
            'state' => 'read',
        ]);
        return view('buyer.profile.servicechat', [
            "title" => "Service",
            'services' => Service::where('user_id', auth()->user()->id)->get(),
        ]);
    }
    public function servicecreate(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request['img_msg']) {
                $validatedData = $request->validate([
                    'message' => 'max:255',
                    'img_msg' => 'image|mimes:jpeg,png,jpg,gif|file|max:2048',
                ]);
                $validatedData['img_msg'] = upload(null, $request->img_msg, 'user', 'call-center', true);
            } else {
                $validatedData = $request->validate([
                    'message' => 'max:255',
                ]);
            }


            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['owner'] = 'user';

            $servicechat = Service::create($validatedData);

            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }
}
