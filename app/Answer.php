<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'group_id',
        'lead_type',
        'entry_message_type',
        'entry_message',
        'output_message',
    ];

    public static $leadTypeDom = [
        'new' => 'Новый',
        'exist' => 'Существующий',
        'all' => 'Любой',
    ];

    public static $leadTypeDefault = 'all';

    public static $entryMessageTypeDom = [
        'exactly' => 'Точное совпадение',
        'exist' => 'Содержит',
        'all' => 'Любое',
    ];

    public static $entryMessageTypeDefault = 'all';
}
