<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function Lead()
    {
        return $this->belongsTo('App\Lead');
    }
}
