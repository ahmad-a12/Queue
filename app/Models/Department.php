<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    use UUID;
    protected $guarded = [];
    public function employee(){
        return $this->hasMany(Employee::class);
    }

    public function job(){
        return $this->hasMany(Job::class);
    }
}
