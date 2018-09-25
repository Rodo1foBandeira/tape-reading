<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    protected $fillable = [
        'name',
        'begin_dt',
        'end_dt'
    ];
}
