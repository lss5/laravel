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
            return self::find($id);
        } else {
            $full_leads = [];
            $leads = self::orderBy('created_at', 'desc')->get();
            foreach ($leads as $lead) {
                $lead['messages'] = self::find($lead['id'])->messages;
                $full_leads[] = $lead;
            }
            return [
                'leads' => $full_leads
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
