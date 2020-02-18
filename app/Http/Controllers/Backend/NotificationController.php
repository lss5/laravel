<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Lead;
use App\VKApi;
use App\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $groups = Lead::select('group_id')->groupBy('group_id')->pluck('group_id', 'group_id');
        return view('backend.notification.index')->with([
            'notifications' => Notification::orderBy('created_at', 'desc')->simplePaginate(6),
            'groups' => $groups,
        ]);
    }

    public function create(Request $request)
    {
        $group = $request->input('group');
        $count = 0;
        $leads = Lead::all();
        try {
            foreach ($leads as $lead) {
                if ($lead->checkAvailable())
                    $count++;
            }
            if ($count == 0)
                throw new \Exception('В базе нет пользователей для отправки сообщения');

            return view('backend.notification.create')->with(['count_users' => $count, 'group' => $group]);
        } catch (\Exception $e) {
            return redirect()->route('admin.notification.index')->withErrors($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'count_users' => 'required|integer',
        ]);
        $message = $request->input('message');
        $count = 0;

        try {
            Lead::where('allow_message', 1)->select('id')->chunk(100, function($leads) use ($message, $request, &$count){
                $leadIds = [];
                foreach ($leads as $lead) {
                    $leadIds[] = $lead->id;
                }
                $leads_str = implode(',', $leadIds);

                $status = VKApi::messagesSend($leads_str, $message);
                $count = intval($request->input('count_users')) < 100 ? intval($request->input('count_users')) : $count + 100;
            });

            Notification::create([
                'count' => $count,
                'message' => $message,
            ]);

            return redirect()->route('admin.notification.index')->with('success', "Сообщение отправлено {$count} пользователю(лям)");
        } catch (\Exception $e) {
            return redirect()->route('admin.notification.index')->withErrors($e->getMessage());
        }

    }
}
