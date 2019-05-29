<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BudgetRepositoryInterface;
use App\Budget;
use DB;

class BudgetRepository extends AbstractRepository implements BudgetRepositoryInterface
{
    protected $model = Budget::class;

     /*
    * Paginação
    */
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC')
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
    * Deletar produto da os
    */
    public function deleteProduct($id, $product_id)
    {
        return DB::table('budget_products')
                    ->where('budget_id','=',$id)
                    ->where('product_id','=',$product_id)
                    ->delete();
    }
}
