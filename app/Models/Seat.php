<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $primaryKey = 'number';
    public $incrementing = false;
    protected $keyType = 'string';

    public function admin(){
        return $this->hasone(Admin::class);
    }

    public function queue(){
        return $this->hasmany(Queue::class);
    }
}
