<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Lead;

class LeadController extends Controller
{
    public function list(Request $request)
    {
        return view('backend.leads')->with('leads', Lead::getLeads());
    }

    public function index(Request $request)
    {
        return view('backend.leads');
    }

    public function destroy(Request $request, $id)
    {
        $lead = Lead::find($id);
        $lead->messages()->delete();
        $lead->delete();

        return redirect()->route('admin.lead.list')->with('success', 'Пользователь удален');
    }
}
