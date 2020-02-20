<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'lead_type',
        'entry_message_type',
        'entry_message',
        'output_message',
        'active',
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

    /**
     * All Answers with replace select values
     */
    public static function getAnswers()
    {
        $answers = self::all()->transform(function($item, $key){
            $item->lead_type = self::$leadTypeDom[$item->lead_type];
            $item->entry_message_type = self::$entryMessageTypeDom[$item->entry_message_type];
            return $item;
        });
        return $answers;
    }
}
