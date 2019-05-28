<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BudgetRepositoryInterface;
use App\Budget;
use DB;

class BudgetRepository extends AbstractRepository implements BudgetRepositoryInterface
{
    protected $model = Budget::class;
    
    /*
    * Create
    */
    public function createProduct(array $data)
    {

        $result = DB::insert('insert into budget_products (budget_id, product_id, amount, value, total_value) values (?, ?, ?, ?, ?)', [$data['budget_id'], $data['product_id'], $data['amount'], $data['value'], $data['total_value'],]);

        return (bool) $result;
    }
}
