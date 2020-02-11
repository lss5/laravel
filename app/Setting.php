<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Setting;

class Setting extends Model
{
    protected $guarded = [];

    public static $access_token;
    public static $confirm_token;
    public static $group_id;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function set_user_setting($user_id, $group_id)
    {
        $settings = self::where(['user_id' => $user_id, 'vk_id_group' => $group_id])->orderBy('created_at', 'desc')->first();
        if (!empty($settings)) {
            self::$access_token = $settings->access_token;
            self::$confirm_token = $settings->confirm_token;
            self::$group_id = $settings->vk_id_group;
            return true;
        } else {
            return false;
        }
    }
}
