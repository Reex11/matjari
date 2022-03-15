<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    // Salary is employee's dues for a month.
        protected $fillable = [
        	'year',
        	'month',
        	'employee',
        	'constantSalary',
        	'totalShifts',
        	'totalRewards',
        	'totalDeducts',
        	'total'
        ];

        public function employee()
        {
            return $this->belongsTo('App\Employee');
        }

}
