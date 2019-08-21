<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Получить всех пользователей
     * 
     * @return array
     */
    public static function getLeads($id = null)
    {
        if (isset($id)) {
            return self::firstOrNew($id);
        } else {
            $leads = self::with('messages')->orderBy('created_at', 'desc')->get();
            return [
                'leads' => $leads
            ];
        }
    }

    /**
     * One To Many
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
