<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Lead;

class Message extends Model
{
    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo('App\Lead');
    }

    public static function getMessages()
    {
        return self::with('lead')->orderBy('created_at', 'desc')->get();
    }

    public function sendAnswer($lead_id)
    {
        // $last_message = Lead::find($lead_id)->messages()->orderBy('created_at', 'desc')->first()->id;
        // var_dump($last_message);
        return true;
    }
}
