<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Executar o comando: php artisan db:seed 
        //para criar as seeds abaixo, (registros)
        $imagem = "/perfils/padrao.png";

        $administrador = \App\User::firstOrCreate(['email'=>'dhemes.mota@gmail.com'],[
            'name' => 'Dhemes Mota',
            'password' => Hash::make('184259'),
            'image' => $imagem,
        ]);

        $gerenteMaster = \App\User::firstOrCreate(['email' => 'carol@gmail.com'], [
            'name' => 'Carol Gerente Master',
            'password' => Hash::make('123456'),
            'image' => $imagem,
        ]);

        $gerente = \App\User::firstOrCreate(['email'=>'gerente@gmail.com'],[
            'name' => 'Usuário Gerente',
            'password' => Hash::make('123456'),
            'image' => $imagem,
        ]);

        $funcionario = \App\User::firstOrCreate(['email'=>'funcionario@gmail.com'],[
            'name' => 'Usuário Funcionário',
            'password' => Hash::make('123456'),
            'image' => $imagem,
        ]);

        $cliente = \App\User::firstOrCreate(['email'=>'cliente@gmail.com'],[
            'name' => 'Usuario Cliente',
            'password' => Hash::make('123456'),
            'image' => $imagem,
        ]);

        echo "Usuários criado! \n";
    }
}
