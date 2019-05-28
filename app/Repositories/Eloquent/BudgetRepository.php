<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BudgetRepositoryInterface;
use App\Budget;

class BudgetRepository extends AbstractRepository implements BudgetRepositoryInterface
{
    protected $model = Budget::class;
    
    /*
    * Create
    */
    public function createProduct(array $data)
    {

        $result = DB::insert('insert into budget_products (id, name) values (?, ?)', [1, 'Dayle']);
        dd("aqui");
        return (bool) $this->model->create($data);
    }
}
