<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'value',
    ];

    public function getValueAttribute($value)
    {
        return $value = str_replace('.', ',', $value);
    }

    public function budgets()
    {
        return $this->belongsToMany('App\Budget');
    }
}
