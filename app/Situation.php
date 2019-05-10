<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
}
