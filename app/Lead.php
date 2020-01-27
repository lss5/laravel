<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

use App\vkApi;

class Lead extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     */
    protected $dates = ['deleted_at'];

    /**
     * Получить всех пользователей со связанными сообщениями.
     * 
     * @return array
     */
    public static function getLeads()
    {
        $leads = self::with('messages')->orderBy('created_at', 'desc')->get();
        // var_dump($leads);
        return $leads;
    }

    /**
     * One To Many
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    /**
     * Запрашиваем данные пользователя по ИД
     * Если изменились/отсутствуют сохраняем
     */
    public function checkNames()
    {
        $user_data = vkApi::getUsers($this->id);
        if (empty($user_data))
            throw new \Exception("Ошибка обновления данных о пользователе");

        foreach ($user_data as $user) {
            if ($this->id == $user['id'] && ($this->first_name != $user['first_name'] || $this->last_name != $user['last_name'])) {
                $this->first_name = $user['first_name'];
                $this->last_name = $user['last_name'];
                $this->save();
            }
        }
        return true;
    }
}
