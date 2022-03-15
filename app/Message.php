<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'shift',
        'employee'
    ];

    public function shift()
    {
    	return $this->belongsTo('App\Shift');
    }

    public function employee()
    {
    	return $this->belongsTo('App\Employee');
    }
}
