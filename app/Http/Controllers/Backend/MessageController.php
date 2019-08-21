<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('backend.message.index', Message::getMessages());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // load the create form (resources/views/backend/message/create.blade.php)
        return view('backend.message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'lead' => 'required|integer',
            'text' => 'required',
        ]);

        $message = new Message();
        $message->lead_id = $request->lead;
        $message->direction = 'out';
        $message->text = $request->text;
        $message->save();

        return redirect()->route('admin.messages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        Message::destroy($id);

        return redirect()->route('admin.messages.index');
    }
}
