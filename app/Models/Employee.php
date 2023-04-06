<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    const IMAGE_PATH = 'images/employee';

    public function documents(){
        return $this->hasMany(EmployeeDocument::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job_title()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function job_level()
    {
        return $this->belongsTo(JobLevel::class);
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }
}
