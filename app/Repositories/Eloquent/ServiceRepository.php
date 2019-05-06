<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Service;

class ServiceRepository extends AbstractRepository implements ServiceRepositoryInterface
{
    protected $model = Service::class;
    
}
