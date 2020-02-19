<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

use App\Lead;
use App\Answer;
use App\VKApi;

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
        try {
            $answers = Answer::where('active', '1')->orderBy('created_at')->get();
            if ($answers->count() == 0)
                throw new \Exception("Не найдены ответы для пользователя {$lead_id}");

            $lead = Lead::find($lead_id);
            if (!$lead)
                throw new \Exception("Пользователь {$lead_id} не найден");

            foreach ($answers as $answer) {
                $status = VKApi::messageSend($lead->id, $answer->output_message);
                if (isset($status['error']))
                    throw new \Exception($status['error']['code'].'-'.$status['error']['description']);

                $lead->messages()->create([
                    'text' => $answer->output_message,
                    'direction' => 'out',
                ]);
            }
        } catch (\Exception $e) {
            log::info($e->getMessage());
        }
    }
}
