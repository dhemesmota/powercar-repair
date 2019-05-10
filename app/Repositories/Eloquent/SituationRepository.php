<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\SituationRepositoryInterface;
use App\Situation;

class SituationRepository extends AbstractRepository implements SituationRepositoryInterface
{
    protected $model = Situation::class;
    
}
