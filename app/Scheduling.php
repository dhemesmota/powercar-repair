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
