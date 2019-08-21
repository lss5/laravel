<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Many To One
     */
    public function lead()
    {
        return $this->belongsTo('App\Lead');
    }

    /**
     * All messages with related leads.
     */
    public static function getMessages()
    {
        return self::with('lead')->orderBy('created_at', 'desc')->get();
    }
}
