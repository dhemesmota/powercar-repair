<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'value',
        'stock',
    ];

    public function getStockAttribute($value)
    {
        return $value == 's' ? 'Sim' : 'Não';
    }
}
