<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function lead()
    {
        return $this->belongsTo('App\Lead');
    }

    public static function getMessages()
    {
        $messages = self::with('lead')->get();

        return [
            'messages' => $messages
        ];
    }
}
