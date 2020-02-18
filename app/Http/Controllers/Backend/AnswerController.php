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
        return view('backend.answer.index')->with(['answers' => Answer::getAnswers()]);
    }

    public function create()
    {
        return view('backend.answer.create')->with([
            'leadTypes' => Answer::$leadTypeDom,
            'leadTypeDefault' => Answer::$leadTypeDefault,
            'entryMessageTypes' => Answer::$entryMessageTypeDom,
            'entryMessageTypeDefault' => Answer::$entryMessageTypeDefault,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'leadType' => ['required', Rule::in(array_keys(Answer::$leadTypeDom))],
            'entryMessageType' => ['required', Rule::in(array_keys(Answer::$entryMessageTypeDom))],
            'entryMessage' => 'required_unless:entryMessageType,all',
            'outputMessage' => 'required',
        ]);

        Answer::create([
            'lead_type' => $request->input('leadType'),
            'entry_message_type' => $request->input('entryMessageType'),
            'entry_message' => $request->input('entryMessage'),
            'output_message' => $request->input('outputMessage'),
        ]);

        return redirect()->route('admin.answer.index')->with('success', 'Ответ на сообщение сохранен');
    }

    public function destroy(Request $request, $id)
    {
        if (Answer::destroy($id)) {
            return redirect()->route('admin.answer.index')->with('success', 'Ответ удален');
        } else {
            return redirect()->route('admin.answer.index')->withErrors('Ошибка удаления');
        }

    }
}
