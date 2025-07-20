<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceChatController extends Controller
{
    public function service_chat_view()
    {
        return view('administrator.service.index', [
            'services' => Service::with('user')
                ->whereIn('created_at', function ($query) {
                    $query->select(DB::raw('MAX(created_at)'))
                        ->from('services')
                        ->groupBy('user_id');
                })
                ->orderBy('created_at', 'desc')
                ->get(),

        ]);
    }

    public function service_chat_detail()
    {
        $id = request('id');
        return view('administrator.service.chat.index', [
            'services' => Service::where('user_id', $id)->get(),
            'userID' => $id,
        ]);
    }

    public function service_chat_create(Request $request)
    {
        try {
            // dd();
            DB::beginTransaction();
            if ($request['img_msg']) {
                $validatedData = $request->validate([
                    'message' => 'max:255',
                    'img_msg' => 'image|mimes:jpeg,png,jpg,gif|file|max:1024',
                ]);
                $validatedData['img_msg'] = $request->file('img_msg')->store('user-service-chat-img');
            } else {
                $validatedData = $request->validate([
                    'message' => 'max:255',
                ]);
            }

            // $validatedData['admin_id'] = auth()->admin->id;
            $validatedData['user_id'] = $request['user_id'];
            $validatedData['owner'] = 'admin';

            $service_chat = Service::create($validatedData);

            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {

            DB::rollback();

            session()->flash('error', $e->getMessage());

            return redirect()->back();
        }
    }
}
