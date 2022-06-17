<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public static function isThereSupportNotification(){
        $support_notification = Notification::firstOrFail();
        return $support_notification->support_notification == true;
    }

    public static function isThereSupportNewSubscriberNotification(){
        $support_notification = Notification::firstOrFail();
        return $support_notification->support_new_subscriber_notification == true;
    }
}
