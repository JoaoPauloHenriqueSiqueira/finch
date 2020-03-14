<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Tasks extends Model
{
    protected $collection = 'tasks';
    protected $fillable = ['name', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Types::class);
    }

    public function buttons()
    {
        return $this->hasMany(Buttons::class, 'task_id', 'id');
    }

     /**
     * The products that belong to the shop.
     */
    public function flows()
    {
        return $this->belongsToMany(Flows::class)
            ->withPivot('note');
    }

    /**
     * Mutator para data
     *
     * @param [type] $date
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i');
    }
}
