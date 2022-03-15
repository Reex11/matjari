<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    
    protected $fillable = [
        'name',
        'isCashier',
        'constantSalary',
        'phone',
        'deviceId'
    ];

    public function shifts()
    {
        return $this->hasMany('App\Shift');
    }

    public function tables()
    {
    	return $this->belongsToMany('App\Table');
    }
}
