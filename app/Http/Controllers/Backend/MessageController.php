<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Message;
use App\Lead;
use App\VKApi;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'lead_id' => 'required|integer',
        ]);

        $lead = Lead::find($request->input('lead_id'));
        if ($lead) {
            return view('backend.message.create')->with([
                'lead_id' => $lead->id,
                'lead_name' => $lead->first_name . ' ' . $lead->last_name,
            ]);
        } else {
            return back()->withErrors('Not found user for sending message');
        }
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'lead_id' => 'required|integer',
            'text' => 'required',
        ]);

        try {
            $lead = Lead::find($request->input('lead_id'));
            if (!$lead)
                throw new \Exception('Пользователь не найден');

            $status = VKApi::messageSend($lead->id, $request->input('text'));
            if (isset($status['error']))
                throw new \Exception($status['error']['code'].'-'.$status['error']['description']);

            $lead->messages()->create([
                'text' => $request->text,
                'direction' => 'out',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.lead.list')->withErrors($e->getMessage());
        }

        return redirect()->route('admin.lead.list')->with('success', 'Сообщение отправлено');
    }
}
