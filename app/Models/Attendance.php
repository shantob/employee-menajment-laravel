<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTodaysAttendanceByUser($query, $user_id){
        return $query->where('date', now()->format('Y-m-d'))
        ->where('user_id', $user_id);
    }
}
