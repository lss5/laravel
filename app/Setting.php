<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Setting extends Model
{
    protected $guarded = [];

    protected static $access_token;
    protected static $confirm_token;
    protected static $group_id;

    public static function setAccessToken($token)
    {
        self::$access_token = $token;
    }

    public static function setConfirmToken($token)
    {
        self::$confirm_token = $token;
    }

    public static function setGroupId($id)
    {
        self::$group_id = $id;
    }

    public static function getAccessToken()
    {
        return self::$access_token;
    }

    public static function getConfirmToken()
    {
        return self::$confirm_token;
    }

    public static function getGroupId()
    {
        return self::$group_id;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function set_user_setting($user_id, $group_id)
    {
        $settings = self::where(['user_id' => $user_id, 'vk_id_group' => $group_id])->orderBy('created_at', 'desc')->first();
        if (!empty($settings)) {
            self::setAccessToken($settings->access_token);
            self::setConfirmToken($settings->confirm_token);
            self::setGroupId($settings->vk_id_group);
            return true;
        } else {
            throw new \Exception("Не найдены настройки для группы", 1);
            return false;
        }
    }
}
