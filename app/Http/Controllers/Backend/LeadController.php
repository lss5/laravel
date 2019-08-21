<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lead;

class LeadController extends Controller
{
    public function index()
    {
        return view('backend.leads')->with('leads', Lead::getLeads());
    }
}
