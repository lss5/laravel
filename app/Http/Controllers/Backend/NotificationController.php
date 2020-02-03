<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lead;
use App\VKApi;
use App\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.notification.index')->with([
            'notifications' => Notification::orderBy('created_at', 'desc')->simplePaginate(6),
        ]);
    }

    public function create(Request $request)
    {
        $count = 0;
        $leads = Lead::all();
        try {
            foreach ($leads as $lead) {
                if ($lead->checkAvailable())
                    $count++;
            }
            if ($count == 0)
                throw new \Exception('В базе нет пользователей для отправки сообщения');

            return view('backend.notification.create')->with(['count_users' => $count]);
        } catch (\Exception $e) {
            return redirect()->route('admin.notification.index')->withErrors($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'count_users' => 'required|integer'
        ]);
        $message = $request->input('message');
        $count = $request->input('count_users');

        Lead::where('allow_message', 1)->select('id')->chunk(100, function($leads) use ($message){
            $leadIds = [];
            foreach ($leads as $lead) {
                $leadIds[] = $lead->id;
            }
            $leads_str = implode(',', $leadIds);

            try {
                $status = VKApi::messagesSend($leads_str, $message);
            } catch (\Exception $e) {
                return redirect()->route('admin.notification.index')->withErrors($e->getMessage());
            }
        });

        $notification = new Notification;
        $notification->count = 
        $notification->message = $message;
        $notification->save();

        return redirect()->route('admin.notification.index')->with('status', "Сообщение отправлено {$count} пользователю(лям)");
    }
}
