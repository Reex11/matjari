<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    
    public function shifts()
    {
    	return $this->hasMany('App\Shift');
    }

    protected $guarded = [];
}
