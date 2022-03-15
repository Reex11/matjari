<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
    	'table',
    	'year',
    	'week',
    	'day',
    	'date',
    	'period',
    	'pos',
    	'value'
    ];

    public function table()
    {
        return $this->belongsTo('App\Table');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

}
