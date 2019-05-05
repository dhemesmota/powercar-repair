<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class ProfileRepository extends AbstractRepository implements ProfileRepositoryInterface
{
    protected $model = Profile::class;

    /*
    * Listagem
    */
    public function allData(int $id)
    {
        return $this->model->where('user_id',$id)->get(); // trazendo todos os dados e ordenando
    }
    
}
