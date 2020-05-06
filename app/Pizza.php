<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    //protected $table = 'some-name';
    protected $casts = [
        'toppings' => 'array'
    ];
}
