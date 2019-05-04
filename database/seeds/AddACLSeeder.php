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
        $adminACL = \App\Role::firstOrCreate(
            ['name'=>'Administrador'],['description' => 'Função de administrador']
        );
        $gerenteMasterACL = \App\Role::firstOrCreate(
            ['name' => 'Gerente Master'], ['description' => 'Função de super gerente']
        );
        $gerenteACL = \App\Role::firstOrCreate(
            ['name'=>'Gerente'],['description' => 'Função de gerente']
        );
        $funcionarioACL = \App\Role::firstOrCreate(
            ['name'=>'Funcionario'],['description' => 'Função de funcionario']
        );
        $clienteACL = \App\Role::firstOrCreate(
            ['name'=>'Cliente'],['description' => 'Função de cliente']
        );

        // Relacionamento User com Role
        $userAdministrador = \App\User::find(1);
        $userGerenteMasterACL = \App\User::find(2);
        $userGerente = \App\User::find(3);
        $userFuncionario = \App\User::find(4);
        $userCliente = \App\User::find(5);

        $userAdministrador->roles()->attach($adminACL);
        $userGerenteMasterACL->roles()->attach($gerenteMasterACL);
        $userGerente->roles()->attach($gerenteACL);
        $userFuncionario->roles()->attach($funcionarioACL);
        $userCliente->roles()->attach($clienteACL);

        // Permissions
        $listUser = \App\Permission::firstOrCreate(
            ['name'=>'list-user'],
            ['description' => 'Listar usuários']
        );
        $createUser = \App\Permission::firstOrCreate(
            ['name'=>'create-user'],
            ['description' => 'Criar usuários']
        );
        $editUser = \App\Permission::firstOrCreate(
            ['name'=>'edit-user'],
            ['description' => 'Editar usuários']
        );
        $showUser = \App\Permission::firstOrCreate(
            ['name'=>'show-user'],
            ['description' => 'Visualizar usuários']
        );
        $deleteUser = \App\Permission::firstOrCreate(
            ['name'=>'delete-user'],
            ['description' => 'Deletar usuários']
        );
        $acessoACL = \App\Permission::firstOrCreate(
            ['name'=>'acl'],
            ['description' => 'Criar, editar, ou deletar funções e permissões']
        );
        // agendamento
        $agendamento = \App\Permission::firstOrCreate(
            ['name' => 'list-scheduling'],
            ['description' => 'Listar agendamentos']
        );
        // ordem de serviço
        $orderService = \App\Permission::firstOrCreate(
            ['name' => 'list-order-service'],
            ['description' => 'Listar ordem de serviço']
        );
        // funcionários
        $listFuncionarios = \App\Permission::firstOrCreate(
            ['name' => 'list-employees'],
            ['description' => 'Listar funcionários']
        );
        // cliente
        $listClientes = \App\Permission::firstOrCreate(
            ['name' => 'list-client'],
            ['description' => 'Listar cliente']
        );
        // cliente
        $produtosEndServicos = \App\Permission::firstOrCreate(
            ['name' => 'list-products-and-services'],
            ['description' => 'Listar produtos e serviços']
        );

        // Relacionar Role com Permissio
        $gerenteMasterACL->permissions()->attach($acessoACL);
        $gerenteACL->permissions()->attach($listUser); 
        $gerenteACL->permissions()->attach($createUser);
        $clienteACL->permissions()->attach($agendamento);
        $funcionarioACL->permissions()->attach($orderService);
        $gerenteACL->permissions()->attach($listFuncionarios);
        $funcionarioACL->permissions()->attach($listClientes);
        $funcionarioACL->permissions()->attach($produtosEndServicos);

        echo "Registros de ACL criado! \n";
    }
}
