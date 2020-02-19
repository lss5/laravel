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
        return view('backend.notification.index')->with([
            'notifications' => Notification::orderBy('created_at', 'desc')->simplePaginate(6),
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
            'message' => 'required|between:1,4096',
            'count_users' => 'required|integer',
        ]);
        $count = 0;

        try {
            $leads = Lead::where('allow_message', 1)->get();
            foreach ($leads as $lead) {
                $message = str_replace('{FIRST_NAME}', $lead->first_name, $request->message);
                VKApi::messageSend($lead->id, $message);
                $count++;
            }

            Notification::create([
                'count' => $count,
                'message' => $request->message,
            ]);

            return redirect()->route('admin.notification.index')->with('success', "Сообщение отправлено {$count} пользователю(лям)");
        } catch (\Exception $e) {
            return redirect()->route('admin.notification.index')->withErrors($e->getMessage());
        }

    }
}
