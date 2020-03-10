<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\VKApi;

class Lead extends Model
{
    protected $guarded = [];

    public static function getLeads()
    {
        return self::with('lastMessage')->get()->sortByDesc('lastMessage.created_at');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function lastMessage()
    {
        return $this->hasOne('App\Message')->latest();
    }

    /**
     * Запрашиваем данные пользователя по ID
     * Если изменились/отсутствуют сохраняем
     */
    public function checkNames()
    {
        $user_data = VKApi::getUsers($this->id);
        if (empty($user_data))
            throw new \Exception("Ошибка получения данных пользователя");

        foreach ($user_data as $user) {
            if ($this->id == $user['id'] && ($this->first_name != $user['first_name'] || $this->last_name != $user['last_name'])) {
                $this->first_name = $user['first_name'];
                $this->last_name = $user['last_name'];
                $this->allow_message = true;
            }
        }
        return true;
    }

    public function checkAvailable()
    {
        if (empty($this->id))
            return false;

        $allow = VKApi::messagesGroupAllowed($this->id);
        if (isset($allow['is_allowed'])) {
            if ($allow['is_allowed']) {
                $this->allow_message = (bool) $allow['is_allowed'];
                $this->save();
                return true;
            } else {
                $this->delete();
                return false;
            }
        }
        throw new \Exception('Ошибка проверки разрешения отправки сообщений пользователю');

        return false;
    }
}
