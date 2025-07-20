<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Service;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\MessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereHas('services')->get();

        $services = null;

        if (request()->ajax()) {
            if (request()->id) {
                $query = Service::where('user_id', request()->id);
                $count = $query;
                $services = $query->get();
                $data['new_count_chat_user'] = $count->where('state',null)->where('owner','user')->count();
                $data['html'] = view('administrator.message.item', ['services' => $services])->render();
                $data['sender'] = User::find(request()->id);
                return $data;
            }
        }
        return view('administrator.message.index', [
            'users' => $users,
            'services' => $services
        ]);
    }

    public function store(MessageRequest $request)
    {
        try {
            DB::beginTransaction();

            $filePath = null;

            if ($request->upload) {
    
                $file_path = upload(null, $request->upload, 'admin', 'call-center', true);
            
                $service = Service::create([
                    'admin_id' => auth()->user()->id,
                    'user_id' => $request->id,
                    'img_msg' => $file_path,
                    'owner' => 'admin'
                ]);
            }

            $service = Service::create([
                'admin_id' => auth()->user()->id,
                'user_id' => $request->id,
                'message' => $request->message,
                'owner' => 'admin'
            ]);

            DB::commit();

            $services = Service::where('user_id', request()->id)->get();

            $data['html'] = view('administrator.message.item', ['services' => $services])->render();

            $data['sender'] = User::find(request()->id);

            $data['message'] = 'success';

            $data['id'] = $request->id;

            return $data;

        } catch (Exception $e) {

            DB::rollback();

            session()->flash();

            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
