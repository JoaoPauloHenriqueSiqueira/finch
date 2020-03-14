<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Types extends Model
{
    protected $collection = 'types';
    protected $fillable = ['title'];

   
    public function task()
    {
        return $this->hasMany(Tasks::class, 'type_id', 'id');
    }
  
}
