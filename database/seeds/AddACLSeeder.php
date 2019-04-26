<?php

use Illuminate\Database\Seeder;

class AddACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminACL = \App\Role::firstOrCreate(['name'=>'Administrador'],[
            'description' => 'Função de administrador'
        ]);
        $gerenteMasterACL = \App\Role::firstOrCreate(['name' => 'Gerente Master'], [
            'description' => 'Função de super gerente'
        ]);
        $gerenteACL = \App\Role::firstOrCreate(['name'=>'Gerente'],[
            'description' => 'Função de gerente'
        ]);
        $usuarioACL = \App\Role::firstOrCreate(['name'=>'Usuario'],[
            'description' => 'Função de usuário'
        ]);

        // Relacionamento User com Role
        $userAdministrador = \App\User::find(1);
        $userGerenteMasterACL = \App\User::find(2);
        $userGerente = \App\User::find(3);
        $userUsuario = \App\User::find(4);

        $userAdministrador->roles()->attach($adminACL);
        $userGerenteMasterACL->roles()->attach($gerenteMasterACL);
        $userGerente->roles()->attach($gerenteACL);
        $userUsuario->roles()->attach($usuarioACL);

        // Permissions
        $listUser = \App\Permission::firstOrCreate(['name'=>'list-user'],[
            'description' => 'Listar usuários'
        ]);
        $createUser = \App\Permission::firstOrCreate(['name'=>'create-user'],[
            'description' => 'Criar usuários'
        ]);
        $editUser = \App\Permission::firstOrCreate(['name'=>'edit-user'],[
            'description' => 'Editar usuários'
        ]);
        $showUser = \App\Permission::firstOrCreate(['name'=>'show-user'],[
            'description' => 'Visualizar usuários'
        ]);
        $deleteUser = \App\Permission::firstOrCreate(['name'=>'delete-user'],[
            'description' => 'Deletar usuários'
        ]);
        $acessoACL = \App\Permission::firstOrCreate(['name'=>'acl'],[
            'description' => 'Acesso total ao sistema'
        ]);

        // Relacionar Role com Permissio
        $gerenteMasterACL->permissions()->attach($acessoACL);
        $gerenteACL->permissions()->attach($listUser);
        $gerenteACL->permissions()->attach($createUser);

        echo "Registros de ACL criado! \n";
    }
}
