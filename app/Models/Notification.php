<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    public static function getNotificationsNumber()
    {
        $notifications = Notification::where('date', '=', date('Y-m-d', strtotime('tomorrow')))->where('opened', '=', false)
            ->count();
        return $notifications;
    }

    public static function getNotifications()
    {
        $notifications = Notification::where('date', '=', date('Y-m-d', strtotime('tomorrow')))->where('opened', '=', false)->get();
        return $notifications;
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:m:s', strtotime($value));
    }
}
