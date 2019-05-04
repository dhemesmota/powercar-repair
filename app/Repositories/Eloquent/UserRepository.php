<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    public function create(array $data)
    {

        //dd($data);
        
        $imagem = "/perfils/padrao.png";
        $data['image'] = $imagem;

        $data['password'] = Hash::make($data['password']);
        $register = $this->model->create($data);

        if(isset($data['roles']) && count($data['roles'])){
            foreach ($data['roles'] as $key => $value){
                // Relacionamento com permissões
                // o $value vai contar o id da permissão
                $register->roles()->attach($value);
            }
        }
        
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
            
            if(isset($data['roles']) && count($data['roles'])){
                foreach ($data['roles'] as $key => $value){
                    // Relacionamento com permissões
                    // o $value vai contar o id da permissão
                    $register->roles()->attach($value);
                }
            }

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
