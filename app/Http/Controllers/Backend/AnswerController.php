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

    public function edit(Request $request, $id)
    {
        return view('backend.answer.edit')->with([
            'answer' => Answer::find($id),
            'leadTypes' => Answer::$leadTypeDom,
            'leadTypeDefault' => Answer::$leadTypeDefault,
            'entryMessageTypes' => Answer::$entryMessageTypeDom,
            'entryMessageTypeDefault' => Answer::$entryMessageTypeDefault,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'lead_type' => ['required', Rule::in(array_keys(Answer::$leadTypeDom))],
            'entry_message_type' => ['required', Rule::in(array_keys(Answer::$entryMessageTypeDom))],
            'entry_message' => 'required_unless:entry_message_type,all',
            'output_message' => 'required',
        ]);

        Answer::create([
            'lead_type' => $request->input('lead_type'),
            'entry_message_type' => $request->input('entry_message_type'),
            'entry_message' => $request->input('entry_message'),
            'output_message' => $request->input('output_message'),
            'active' => $request->input('active'),
        ]);

        return redirect()->route('admin.answer.index')->with('success', 'Ответ на сообщение сохранен');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'lead_type' => ['required', Rule::in(array_keys(Answer::$leadTypeDom))],
            'entry_message_type' => ['required', Rule::in(array_keys(Answer::$entryMessageTypeDom))],
            'entry_message' => 'required_unless:entry_message_type,all',
            'output_message' => 'required',
        ]);

        Answer::where('id', $id)->update([
            'lead_type' => $request->input('lead_type'),
            'entry_message_type' => $request->input('entry_message_type'),
            'entry_message' => $request->input('entry_message'),
            'output_message' => $request->input('output_message'),
            'active' => $request->input('active'),
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
