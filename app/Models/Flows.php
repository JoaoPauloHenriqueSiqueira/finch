<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Flows extends Model
{
    protected $collection = 'flows';
    protected $fillable = ['user_id','note'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The products that belong to the shop.
     */
    public function tasks()
    {
        return $this->belongsToMany(Tasks::class)
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
