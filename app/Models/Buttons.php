<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Buttons extends Model
{
    protected $collection = 'buttons';
    protected $fillable = ['task_id','next_id','finish'];

    public function task()
    {
        return $this->belongsToMany(Tasks::class);
    }
}
