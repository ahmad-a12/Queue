<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;
    use UUID;
    protected $guarded= [];
    protected $dates = ['birthdate'];
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function job(){
        return $this->belongsTo(Job::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function admin(){
        return $this->hasone(Admin::class);
    }
}