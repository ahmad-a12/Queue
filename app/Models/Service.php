<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use UUID;
    protected $guarded = [] ;
    public function queue(){
        return $this->hasMany(Queue::class);
    }
    public function employee(){
        return $this->hasMany(Employee::class);
    }
}
