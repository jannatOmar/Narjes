<?php


namespace App\Helpers;


use App\Models\Notifications;

class General
{

    public static function getNotifications(){

        return $notifications = Notifications::selection()->where('read',0)->where('recive_id',auth()->user()->id)->get();

    }
}
