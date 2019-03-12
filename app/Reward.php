<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'isDeduct',
        'employee',
        'title',
        'description',
        'date',
        'amount'
    ];

}
