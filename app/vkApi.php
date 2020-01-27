<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vkApi extends Model
{
    public static function call($method, array $params)
    {
        $params['access_token'] = config('services.vk.access_token');
        $params['v'] = config('services.vk.vk_api_version');

        $url = config('services.vk.vk_api_url');

        $query = http_build_query($params);
        $url = $url.$method.'?'.$query;
    
        $response = json_decode(file_get_contents($url), true);
        return $response['response'];
    }

    public static function getUsers($user_id)
    {
        return self::call('users.get', array(
            'user_id' => $user_id,
        ));
    }
}
