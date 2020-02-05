<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    public function index()
    {
        return view('backend.answer.index'); //->with(['messages' => Message::getMessages()]);
    }

    public function create()
    {
        return view('backend.answer.create'); //->with(['lead' => $request->input('lead_id')]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'label' => 'alpha',
            'message' => 'required',
            'answer' => 'required'
        ]);

        return redirect()->route('admin.answer.index')->with('status', 'Ответ на сообщение сохранен');
    }
}
