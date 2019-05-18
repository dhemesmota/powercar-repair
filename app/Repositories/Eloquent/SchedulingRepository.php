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
        $isCliente = auth()->user()->hasRole('Cliente');
        if($isCliente) {
            $clienteId = auth()->user()->id; // buscando id do cliente logado
            return $this->model
                    ->where('user_id', '=', $clienteId)
                    ->join('situations','schedulings.situation_id', '=', 'situations.id')
                    ->select('schedulings.*','situations.name', 'situations.description', 'situations.color')
                    ->orderBy($column, $order)
                    ->paginate($paginate);
        } else {
            return $this->model
                    ->join('situations','schedulings.situation_id', '=', 'situations.id')
                    ->select('schedulings.*','situations.name', 'situations.description', 'situations.color')
                    ->orderBy($column, $order)
                    ->paginate($paginate);
        }
    }

    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC')
    {
        // Fazendo um join com situações e retornando todos os dados referente a busca
        // verificar se é cliente, se for listar apenas os seus proprios agendamentos
        $isCliente = auth()->user()->hasRole('Cliente');
        if ($isCliente) {
            $clienteId = auth()->user()->id; // buscando id do cliente logado
            $query = $this->model
                    ->where('user_id', '=', $clienteId)
                    ->join('situations', 'schedulings.situation_id', '=', 'situations.id')
                    ->select('schedulings.*', 'situations.name', 'situations.description', 'situations.color');
        } else {
            $query = $this->model
                ->join('situations', 'schedulings.situation_id', '=', 'situations.id')
                ->select('schedulings.*', 'situations.name', 'situations.description', 'situations.color');
        }
        foreach ($columns as $key => $value) {
            $query = $query->orWhere($value, 'like', '%' . $search . '%'); /// falta corrigir listagem quando usa o buscar, por enquanto ta listando tudo, listar apenas os dados do usuario cliente logado
        }
        

        return $query->orderBy($column, $order)->get();
    }


    
}
