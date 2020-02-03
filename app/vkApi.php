<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VKApi extends Model
{
    public static function call($method, array $params)
    {
        $params['access_token'] = config('services.vk.access_token');
        $params['v'] = config('services.vk.vk_api_version');

        $url = config('services.vk.vk_api_url');
        $query = http_build_query($params);
        $url = $url.$method.'?'.$query;
    
        $response = json_decode(file_get_contents($url), true);
        if (isset($response['error']))
            throw new \Exception($response['error']['error_code'] . ': ' . $response['error']['error_msg']);

        return $response['response'];
    }

    public static function getUsers($user_id)
    {
        return self::call('users.get', [
            'user_id' => $user_id,
        ]);
    }

    public static function messageSend($user_id, $message)
    {
        return self::call('messages.send', [
            'user_id'    => $user_id,
            'message'    => $message,
            'random_id'  => random_int(100000000, 999999999) . $user_id,
        ]);
    }

    public static function messagesSend($user_ids, $message)
    {
        $postfix = explode(',', $user_ids);
        return self::call('messages.send', [
            'user_ids'    => $user_ids,
            'message'    => $message,
            'random_id'  => random_int(100000000, 999999999) . reset($postfix),
        ]);
    }

    public static function messagesGroupAllowed($user_id)
    {
        return self::call('messages.isMessagesFromGroupAllowed', [
            'group_id' => config('services.vk.vk_group_id'),
            'user_id' => $user_id,
        ]);
    }
}
