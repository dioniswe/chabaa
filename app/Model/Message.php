<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

use Illuminate\Support\Facades\Log;
class Message extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
    //

    public static function recentMessages() {
        $nowDate = new \DateTime();
        $oneDayInterval = new \DateInterval('P1D');
        $yesterday = $nowDate->sub($oneDayInterval);
        return static::with('user')->where('created_at', '>', $yesterday->format('Y-m-d H:i:s'));
    }
}
