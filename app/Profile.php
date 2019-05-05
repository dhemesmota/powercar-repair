<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'cpf',
        'telephone',
        'address',
        'neighborhood',
        'zip_code',
    ];

    /**
     * Relacionamento para pegar o usuário que tem os determinados 
     * registros
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Teste, enviar nome do usuário
     */
    public function getUsuarioAttribute()
    {
        return $this->user->name;
    }
}
