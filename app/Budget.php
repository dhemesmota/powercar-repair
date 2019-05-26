<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'description', 'total_price', 'client_id', 'vehicle_id', 'employee_id'
    ];

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
