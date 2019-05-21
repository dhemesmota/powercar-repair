<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\SchedulingRepositoryInterface;
use App\Scheduling;
use DB;

class SchedulingRepository extends AbstractRepository implements SchedulingRepositoryInterface
{
    protected $model = Scheduling::class;

    /*
    * Paginação, 
    * Implementar para que o cliente veja apenas os seus agendamentos
    * se não for cliente, poderá ver todos os agendamentos.
    * para metodos paginate e findWhereLike
    */
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC')
    {
        // Fazendo um join com situações e retornando todos os dados

        // verificar se é cliente, se for listar apenas os seus proprios agendamentos
        $isCliente = auth()->user()->isClient();
        if($isCliente) {
            $clienteId = auth()->user()->id; // buscando id do cliente logado
            return $this->model
                    ->where('user_id', '=', $clienteId)
                    ->join('situations','schedulings.situation_id', '=', 'situations.id')
                    ->select('schedulings.*','situations.name', 'situations.description as status_description', 'situations.color')
                    ->orderBy($column, $order)
                    ->paginate($paginate);
        } else {
            return $this->model
                    ->join('situations','schedulings.situation_id', '=', 'situations.id')
                    ->join('users','schedulings.user_id', '=', 'users.id')
                    ->select('schedulings.*','situations.name', 'situations.description as status_description', 'situations.color', 'users.name as client')
                    ->orderBy($column, $order)
                    ->paginate($paginate);
        }
    }

    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC')
    {
        // Fazendo um join com situações e retornando todos os dados referente a busca
        // verificar se é cliente, se for listar apenas os seus proprios agendamentos
        $this->search = $search;
        $isCliente = auth()->user()->hasRole('Cliente');
        if ($isCliente) {
            $clienteId = auth()->user()->id; // buscando id do cliente logado
            $query = $this->model
                    ->where('user_id', '=', $clienteId)
                    ->Where(function($query){
                        // usando filtro de busca
                        $query->where('date', 'like', '%' . $this->search . '%')
                              ->orWhere('hour', 'like', '%' . $this->search . '%');
                    })
                    ->join('situations', 'schedulings.situation_id', '=', 'situations.id')
                    ->select('schedulings.*', 'situations.name', 'situations.description as status_description', 'situations.color');
            
        } else {
            $query = $this->model
                ->orWhere('date', 'like', '%' . $search . '%')
                ->orWhere('hour', 'like', '%' . $search . '%')
                ->orWhere('users.name', 'like', '%' . $search . '%')
                ->orWhere('schedulings.description', 'like', '%' . $search . '%')
                ->orWhere('situations.name', 'like', '%' . $search . '%')
                ->join('situations', 'schedulings.situation_id', '=', 'situations.id')
                ->join('users','schedulings.user_id', '=', 'users.id')
                ->select('schedulings.*', 'situations.name', 'situations.description as status_description', 'situations.color', 'users.name as client');
        }
        

        return $query->orderBy($column, $order)->get();
    }


    
}
