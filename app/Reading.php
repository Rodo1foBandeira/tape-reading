<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'active_id',
        'price',
        'volume',
        'moment'
    ];
}
