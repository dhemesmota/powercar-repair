<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'model', 'color', 'year', 'board', 'user_id',
    ];

    /**
     * Relacionando veículos com usuário
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getBoardAttribute($value)
    {
        return strtoupper($value);
    }
    public function setBoardAttribute($value)
    {
        return $this->attributes['board'] = strtoupper($value);
    }
}
