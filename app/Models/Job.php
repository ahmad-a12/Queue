<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    use UUID;
    protected $guarded = [];
    public function employee(){
        return $this->hasMany(Employee::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
