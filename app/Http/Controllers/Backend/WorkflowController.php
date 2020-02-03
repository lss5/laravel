<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkflowController extends Controller
{
    public function index()
    {
        return view('backend.workflow.index'); //->with(['messages' => Message::getMessages()]);
    }

    public function create()
    {
        return view('backend.worflow.create'); //->with(['lead' => $request->input('lead_id')]);
    }
}
