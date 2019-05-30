<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BudgetRepositoryInterface;
use App\Budget;
use DB;

class BudgetRepository extends AbstractRepository implements BudgetRepositoryInterface
{
    protected $model = Budget::class;

    /*
    * Atualizar dados pelo id
    */
    public function updateVehicle(array $data, int $id)
    {
        $register = $this->find($id);
        if($register){
            return (bool) DB::table('budgets')->where('id','=',$id)->update(['vehicle_id' => $data['vehicle_id']]);
        } else {
            return false;
        }
    }

    public function update(array $data, int $id)
    {
        $register = $this->find($id);
        if($register){
            return (bool) DB::table('budgets')->where('id','=',$id)->update(['situation_id' => $data['situation_id']]);
        } else {
            return false;
        }
    }

     /*
    * Paginação
    */
    public function paginate(int $paginate = 10, string $column = 'created_at', string $order = 'DESC')
    {
        /**
         * Retornando todos os usuários funcionários
         */
        $isClient = auth()->user()->isClient();
        if (!$isClient) {
            return DB::table('budgets')
                ->join('users AS us', 'budgets.client_id', '=', 'us.id')
                ->leftJoin('vehicles', 'budgets.vehicle_id', '=', 'vehicles.id')
                ->join('users AS ep', 'budgets.employee_id', '=', 'ep.id')
                ->join('situations', 'budgets.situation_id', '=', 'situations.id')
                ->select('budgets.*', 'us.name as client', 'vehicles.model','ep.name as employee','situations.name', 'situations.description as status_description', 'situations.color')
                ->orderBy('budgets.'.$column, $order)
                ->paginate($paginate);
        } else {
            $idCliente = auth()->user()->id;
                return DB::table('budgets')
                ->join('users AS us', 'budgets.client_id', '=', 'us.id')
                ->leftJoin('vehicles', 'budgets.vehicle_id', '=', 'vehicles.id')
                ->join('users AS ep', 'budgets.employee_id', '=', 'ep.id')
                ->join('situations', 'budgets.situation_id', '=', 'situations.id')
                ->select('budgets.*', 'us.name as client', 'vehicles.model','ep.name as employee','situations.name', 'situations.description as status_description', 'situations.color')
                ->where('budgets.client_id','=',$idCliente)
                ->orderBy('budgets.'.$column, $order)
                ->paginate($paginate);
        }

    }

    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC')
    {
        // Fazendo um join com situações e retornando todos os dados referente a busca
        // verificar se é cliente, se for listar apenas os seus proprios agendamentos
        $this->search = $search;
        
        $query = DB::table('budgets')
        ->join('users AS us', 'budgets.client_id', '=', 'us.id')
        ->leftJoin('vehicles', 'budgets.vehicle_id', '=', 'vehicles.id')
        ->join('users AS ep', 'budgets.employee_id', '=', 'ep.id')
        ->join('situations', 'budgets.situation_id', '=', 'situations.id')
            ->orWhere('budgets.description', 'like', '%' . $search . '%')
            ->orWhere('budgets.id', 'like', '%' . $search . '%')
            ->orWhere('vehicles.model', 'like', '%' . $search . '%')
            ->orWhere('budgets.total_price', 'like', '%' . $search . '%')
            ->orWhere('ep.name', 'like', '%' . $search . '%')
            ->orWhere('situations.name', 'like', '%' . $search . '%')
            ->select('budgets.*', 'us.name as client', 'vehicles.model','ep.name as employee','situations.name', 'situations.description as status_description', 'situations.color');
        

        return $query->orderBy($column, $order)->get();
    }

    /*
    * Buscar dados pelo id
    */
    public function find(int $id)
    {
        return DB::table('budgets')
                ->join('users AS us', 'budgets.client_id', '=', 'us.id')
                ->leftJoin('vehicles', 'budgets.vehicle_id', '=', 'vehicles.id')
                ->join('users AS ep', 'budgets.employee_id', '=', 'ep.id')
                ->join('situations', 'budgets.situation_id', '=', 'situations.id')
                ->select('budgets.*', 'us.name as client', 'vehicles.model','ep.name as employee','situations.name', 'situations.description as status_description', 'situations.color')
                ->where('budgets.id','=',$id)
                ->get();
    }
    
    /*
    * Create
    */
    public function createProduct(array $data)
    {

        $result = DB::insert('insert into budget_products (budget_id, product_id, amount, value, total_value) values (?, ?, ?, ?, ?)', [$data['budget_id'], $data['product_id'], $data['amount'], $data['value'], $data['total_value'],]);

        return (bool) $result;
    }

    /*
    * Deletar dados pelo id
    */
    public function delete(int $id)
    {
        $register = $this->find($id);
        if($register){
            DB::table('budget_products')
                    ->where('budget_id','=',$id)
                    ->delete();
            DB::table('budget_services')
                    ->where('budget_id','=',$id)
                    ->delete();
            return (bool) DB::table('budgets')
                            ->where('id','=',$id)
                            ->delete();
        } else {
            return false;
        }
    }

    /*
    * Deletar produto da os
    */
    public function deleteProduct($id, $product_id)
    {
        return DB::table('budget_products')
                    ->where('budget_id','=',$id)
                    ->where('product_id','=',$product_id)
                    ->delete();
    }

    /*
    * Create
    */
    public function createService(array $data)
    {

        $result = DB::insert('insert into budget_services (budget_id, service_id) values (?, ?)', [$data['budget_id'], $data['service_id']]);

        return (bool) $result;
    }

    /*
    * Deletar produto da os
    */
    public function deleteService($id, $service_id)
    {
        return DB::table('budget_services')
                    ->where('budget_id','=',$id)
                    ->where('service_id','=',$service_id)
                    ->delete();
    }
}
