<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\VehicleRepositoryInterface;
use App\Vehicle;

class VehicleRepository extends AbstractRepository implements VehicleRepositoryInterface
{
    protected $model = Vehicle::class;

    /*
    * Paginação
    */
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC')
    {
        $userId = auth()->user()->id; // pegando o id do usuario logado
        // Listando uruários que não seja administrador
        return $this->model->where('user_id', '=', $userId)->orderBy($column, $order)->paginate($paginate);
    }

    /*
    * Create
    */
    public function create(array $data)
    {
        $user = Auth()->user();
        $data['user_id'] = $user->id;
        
        return (bool)$this->model->create($data);
    }


    /*
    * Atualizar dados pelo id
    */
    public function update(array $data, int $id)
    {
        $register = $this->find($id);
        if ($register) {
            $user = Auth()->user();
            $data['user_id'] = $user->id;
            return (bool)$register->update($data);
        } else {
            return false;
        }
    }
}
