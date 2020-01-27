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
}
