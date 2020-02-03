<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Message;
use App\Lead;
use App\VKApi;

class MessageController extends Controller
{
    public function index()
    {
        return view('backend.message.index')->with(['messages' => Message::getMessages()]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'lead_id' => 'required|integer',
        ]);

        $lead = Lead::find($request->input('lead_id'));
        if ($lead) {
            return view('backend.message.create')->with([
                'lead_id' => $request->input('lead_id'),
                'lead_name' => $lead->first_name . ' ' . $lead->last_name,
            ]);
        } else {
            return back()->withErrors('Not found user for sending message');
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'lead_id' => 'required|integer',
            'text' => 'required',
        ]);

        try {
            $lead = Lead::find($request->input('lead_id'));
            if (!$lead)
                throw new \Exception('Пользователь не найден');

            $status = VKApi::messageSend($lead->id, $request->text);
            if (isset($status['error']))
                throw new \Exception($status['error']['code'].'-'.$status['error']['description']);

            $lead->messages()->create([
                'text' => $request->text,
                'direction' => 'out',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.lead.list')->withErrors($e->getMessage());
        }

        return redirect()->route('admin.lead.list')->with('status', 'Сообщение отправлено');
    }

    // public function destroy(Request $request, $id)
    // {
    //     Message::destroy($id);

    //     return redirect()->route('admin.lead.list');
    // }
}
