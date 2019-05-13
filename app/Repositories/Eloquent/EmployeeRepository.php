<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use DB;

class EmployeeRepository extends AbstractRepository implements EmployeeRepositoryInterface
{
    protected $model = User::class;
    protected $modelProfile = Profile::class;

    /*
    * Paginação
    */
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC')
    {
        /**
         * Retornando todos os usuários funcionários
         */
        return DB::table('users')
            ->join('role_user', function ($join) {
                $join->on('users.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', '=', 4);
            })
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*', 'profiles.telephone')
            ->orderBy('users.'.$column, $order)
            ->paginate($paginate);

    }

    /*
    * Buscar dados pelo id
    */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {

        //dd($data);
        
        $imagem = "/perfils/padrao.png";
        $data['image'] = $imagem;

        $data['password'] = Hash::make($data['password']);
        $register = $this->model->create($data);

        $register->roles()->attach(4);
        
        return (bool) $register;
    }

    public function update(array $data, int $id)
    {
        $register = $this->find($id);

        //dd($register);
        if($register){
            if($data['password'] ?? false){
                $data['password'] = Hash::make($data['password']);
            }

            $roles = $register->roles; // Receber todas as funções que a usuario possui
            // Verificar se já possui a função, se sim, remover todas para atribuir novas abaixo
            if(count($roles)){
                // Percorrer a lista de funções e remover
                foreach ($roles as $key => $value){
                    $register->roles()->detach($value->id);
                }
            }
            
            $register->roles()->attach(4);

            // imagem padrão
            if (isset($data['image']) && $data['image']->isValid()) {

                //$imagem = "/perfils/padrao.png";
                //$data['image'] = $imagem;

                $time = time();
                $diretorioPai = 'perfils';
                $diretorioImagem = $diretorioPai.DIRECTORY_SEPARATOR.'perfil_id'.$id;
                $extensao = $data['image']->extension();

                

                $urlImagem = $diretorioImagem.DIRECTORY_SEPARATOR.$data['image'];
                
                $file = str_replace('data:image/'.$extensao.';base64,','',$data[ 'image']);
                $file = base64_decode($file);

                if (!file_exists($diretorioPai)) {
                    mkdir($diretorioPai, 0700);
                }

                if (!file_exists($diretorioImagem)) {
                    mkdir($diretorioImagem, 0700);
                }

                //file_put_contents($urlImagem, $file);

                // ainda não conseguir salvar imagens
                $imagem = "/perfils/padrao.png";
                $data['image'] = $imagem;
            }

            return (bool) $register->update($data);
        } else {
            return false;
        }
    }
    
}
