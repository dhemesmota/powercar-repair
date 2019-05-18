<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    protected $fillable = [
        'date',
        'hour',
        'user_id',
        'situation_id'
    ];

    /**
     * formatar data
     */
    public function getDateAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    /**
     * formatar hora
     */
    public function getHourAttribute($value)
    {
        return date('H\hi', strtotime($value));
    }

    // Um agendamento pode ser apenas de um usuário
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    // Um agendamento só pode ter um tipo de status
    public function situations()
    {
        return $this->belongsTo('App\Situation');
    }

}
