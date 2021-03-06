<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Lead;
use App\VKApi;
use App\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.notifications.index')->with([
            'notifications' => Notification::orderBy('created_at', 'desc')->simplePaginate(6),
        ]);
    }

    public function create(Request $request)
    {
        $leads = Lead::where('updated_at', '<=', Carbon::now()->subDay())->get();
        try {
            $count_leads_updated = 0;
            foreach ($leads as $lead) {
                if (!$lead->checkAvailable())
                    $count_leads_updated++;
            }

            return view('backend.notifications.create')->with([
                'count_leads_updated' => $count_leads_updated,
                'count_leads' => Lead::count(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.notification.index')->withErrors($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|between:1,4096',
        ]);

        try {
            $count_messages_sent = 0;
            $leads = Lead::where('allow_message', 1)->orderBy('created_at', 'desc')->get();
            foreach ($leads as $lead) {
                $message = str_replace('{FIRST_NAME}', $lead->first_name, $request->message);
                VKApi::messageSend($lead->id, $message);
                $count_messages_sent++;
            }

            Notification::create([
                'count' => $count_messages_sent,
                'message' => $request->message,
            ]);

            return redirect()->route('admin.notification.index')->with('success', "Сообщение отправлено {$count_messages_sent} пользователю(лям)");
        } catch (\Exception $e) {
            return redirect()->route('admin.notification.index')->withErrors($e->getMessage());
        }

    }
}
