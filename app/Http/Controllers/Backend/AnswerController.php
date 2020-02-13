<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Answer;
use App\Lead;

class AnswerController extends Controller
{
    public function index()
    {
        return view('backend.answer.index')->with(['answers' => Answer::all()]);
    }

    public function create()
    {
        $groups = Lead::select('group_id')->groupBy('group_id')->pluck('group_id', 'group_id');
        return view('backend.answer.create')->with([
            'groups' => $groups,
            'leadTypes' => Answer::$leadTypeDom,
            'leadTypeDefault' => Answer::$leadTypeDefault,
            'entryMessageTypes' => Answer::$entryMessageTypeDom,
            'entryMessageTypeDefault' => Answer::$entryMessageTypeDefault,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'group' => 'required|integer',
            'leadType' => ['required', Rule::in(array_keys(Answer::$leadTypeDom))],
            'entryMessageType' => ['required', Rule::in(array_keys(Answer::$entryMessageTypeDom))],
            'entryMessage' => 'required_unless:entryMessageType,all',
            'outputMessage' => 'required',
        ]);

        Answer::create([
            'group_id' => $request->input('group'),
            'lead_type' => $request->input('leadType'),
            'entry_message_type' => $request->input('entryMessageType'),
            'entry_message' => $request->input('entryMessage'),
            'output_message' => $request->input('outputMessage'),
        ]);

        return redirect()->route('admin.answer.index')->with('status', 'Ответ на сообщение сохранен');
    }
}
