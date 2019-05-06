<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Product;

class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    protected $model = Product::class;
    
}
