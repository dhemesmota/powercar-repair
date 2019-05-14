<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
    ];

    /**
     * Alterar o nome da cor quando consultada
     */
    /*
    public function getColorAttribute($value)
    {
        switch($value){
            case "primary":
                return "Azul";
                break;
            case "success":
                return "Verde";
                break;
            case "warning":
                return "Amarelo";
                break;
            case "danger":
                return "Vermelho";
                break;
            case "secondary":
                return "Cinza";
                break;
            case "info":
                return "Azul Claro";
                break;
            case "light":
                return "Claro";
                break;
            case "dark":
                return "Preto";
                break;
            default:
                return $value;
        }
        return $value;
    }
    */

    /*
    * Criando um relacionamento do usuário com agendamentos
    */
    public function schedulings()
    {
        return $this->hasMany('App\Scheduling');
    }
}
