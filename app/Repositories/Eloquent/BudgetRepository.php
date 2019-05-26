<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BudgetRepositoryInterface;
use App\Budget;

class BudgetRepository extends AbstractRepository implements BudgetRepositoryInterface
{
    protected $model = Budget::class;
    
}
