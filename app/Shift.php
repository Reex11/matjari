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
    	'employee',
    	'value'
    ];

}
