<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Message;
use App\Lead;

class InboundController extends Controller
{
    const EVENT_CONFIRM = 'confirmation';
    const EVENT_MESSAGE_NEW = 'message_new';

    public function new(Request $request)
    {
        switch ($request->input("type")) {
            case self::EVENT_CONFIRM:
                return response(config("services.vk.confirmation_token"), 200);
            break;

            case self::EVENT_MESSAGE_NEW:
                $this->newMessage($request);
            break;
        }

        return response('ok', 200);
    }

    public function newMessage($request)
    {
        try {
            $lead_id = $request->input("object.user_id");
            $lead_message = $request->input("object.message");
            if (empty($lead_id))
                throw new \Exception("Нет идентификатора пользователя");

            $lead = Lead::firstOrCreate(['id' => $lead_id]);
            $lead->id = $lead_id; // TODO: после сохранение пустое значение this->id
            $lead->checkNames(); // Обновляем/заполняем данные пользователя
            $lead->messages()->create([ // Добавляем сообщение к записи пользователя
                'text' => $lead_message,
                'direction' => 'in',
            ]);
            // $message_id = $lead->messages()->orderBy('created_at', 'desc')->first()->id;

            /* Отправляем пользователю ответное сообщение */
            $message = new Message();
            $message->sendAnswer($lead->id);
        } catch (\Exception $e) {
            //TODO: Добавить запись логов в случае ошибки
            var_dump($e->getMessage());
        }
    }
}