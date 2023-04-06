<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public static function addDays($user_id){
        
        $record = static::where('user_id', $user_id)->where('month', 'LIKE', date('m-Y'))->first();

        if(!$record) {
            static::addRecord($user_id);
            return true;
        };

        $record->increment('days');
        return true;
    }

    public static function addHours($user_id, $attendance){
        
        $record = static::where('user_id', $user_id)->where('month', 'LIKE', date('m-Y'))->first();

        if(!$record) $record = static::addRecord($user_id);

        $hours = hour_difference($attendance->enter_time, $attendance->exit_time);

        $record->hours += $hours['hour_min'];
        $record->save();
    }

    public static function addRecord($user_id)
    {
        return static::create([
            'user_id' => $user_id,
            'month' => date('m-Y'),
            'days' => 1,
            'hours' => 0
        ]);
    }
}
