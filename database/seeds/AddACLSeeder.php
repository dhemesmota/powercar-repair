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
        // ordem de serviço
        $orderService = \App\Permission::firstOrCreate(
            ['name' => 'list-order-service'],
            ['description' => 'Listar ordem de serviço']
        );
        // funcionários
        $listFuncionarios = \App\Permission::firstOrCreate(
            ['name' => 'list-employee'],
            ['description' => 'Listar funcionários']
        );
        // cliente
            $listClient = \App\Permission::firstOrCreate(
                ['name' => 'list-client'],
                ['description' => 'Listar cliente']
            );
            $createClient = \App\Permission::firstOrCreate(
                ['name' => 'create-client'],
                ['description' => 'Criar cliente']
            );
            $deleteClient = \App\Permission::firstOrCreate(
                ['name' => 'delete-client'],
                ['description' => 'Deletar cliente']
            );
            $showClient = \App\Permission::firstOrCreate(
                ['name' => 'show-client'],
                ['description' => 'Ver cliente']
            );
            $editClient = \App\Permission::firstOrCreate(
                ['name' => 'edit-client'],
                ['description' => 'Editar cliente']
            );
        // produtos e serviços
        $produtosEndServicos = \App\Permission::firstOrCreate(
            ['name' => 'list-products-and-services'],
            ['description' => 'Listar produtos e serviços']
        );
        // produtos
            $listProduct = \App\Permission::firstOrCreate(
                ['name' => 'list-product'],
                ['description' => 'Listar produtos']
            );
            $createProduct = \App\Permission::firstOrCreate(
                ['name' => 'create-product'],
                ['description' => 'Criar produtos']
            );
            $editProduct = \App\Permission::firstOrCreate(
                ['name' => 'edit-product'],
                ['description' => 'edit produtos']
            );
            $deleteProduct = \App\Permission::firstOrCreate(
                ['name' => 'delete-product'],
                ['description' => 'Deletar produtos']
            );
            $showProduct = \App\Permission::firstOrCreate(
                ['name' => 'show-product'],
                ['description' => 'Ver produtos']
            );
        // serviços
            $listService = \App\Permission::firstOrCreate(
                ['name' => 'list-service'],
                ['description' => 'Listar serviços']
            );
            $createService = \App\Permission::firstOrCreate(
                ['name' => 'create-service'],
                ['description' => 'Criar serviços']
            );
            $editService = \App\Permission::firstOrCreate(
                ['name' => 'edit-service'],
                ['description' => 'edit serviços']
            );
            $deleteService = \App\Permission::firstOrCreate(
                ['name' => 'delete-service'],
                ['description' => 'Deletar serviços']
            );
            $showService = \App\Permission::firstOrCreate(
                ['name' => 'show-service'],
                ['description' => 'Ver serviços']
            );
        // automóvies
            $listVehicle = \App\Permission::firstOrCreate(
                ['name' => 'list-vehicle'],
                ['description' => 'Listar automóvies']
            );
            $createVehicle = \App\Permission::firstOrCreate(
                ['name' => 'create-vehicle'],
                ['description' => 'Criar automóvies']
            );
            $showVehicle = \App\Permission::firstOrCreate(
                ['name' => 'show-vehicle'],
                ['description' => 'Ver automóvies']
            );
            $deleteVehicle = \App\Permission::firstOrCreate(
                ['name' => 'delete-vehicle'],
                ['description' => 'Deletar automóvies']
            );
            $editVehicle = \App\Permission::firstOrCreate(
                ['name' => 'edit-vehicle'],
                ['description' => 'Editar automóvies']
            );

        // list-scheduling
            $listScheduling = \App\Permission::firstOrCreate(
                ['name' => 'list-scheduling'],
                ['description' => 'Listar agendamentos']
            );
            $approveScheduling = \App\Permission::firstOrCreate(
                ['name' => 'approve-scheduling'],
                ['description' => 'Aprovar agendamentos']
            );
            $cancelScheduling = \App\Permission::firstOrCreate(
                ['name' => 'cancel-scheduling'],
                ['description' => 'cancelar agendamentos']
            );
            $deleteScheduling = \App\Permission::firstOrCreate(
                ['name' => 'delete-scheduling'],
                ['description' => 'Deletar agendamentos']
            );
            $editScheduling = \App\Permission::firstOrCreate(
                ['name' => 'edit-scheduling'],
                ['description' => 'Editar agendamentos']
            );
            $createScheduling = \App\Permission::firstOrCreate(
                ['name' => 'create-scheduling'],
                ['description' => 'Criar agendamentos']
            );
            $showScheduling = \App\Permission::firstOrCreate(
                ['name' => 'show-scheduling'],
                ['description' => 'Ver agendamentos']
            );

        // Relacionar Role com Permissio
        $gerenteMasterACL->permissions()->attach($acessoACL);
        $gerenteACL->permissions()->attach($listUser); 
        $gerenteACL->permissions()->attach($createUser);

        // Vehicle
        $clienteACL->permissions()->attach($listVehicle);
        $clienteACL->permissions()->attach($deleteVehicle);
        $clienteACL->permissions()->attach($createVehicle);
        $clienteACL->permissions()->attach($showVehicle);
        $clienteACL->permissions()->attach($editVehicle);

        $gerenteACL->permissions()->attach($listVehicle);
        $gerenteMasterACL->permissions()->attach($listVehicle);
        $funcionarioACL->permissions()->attach($listVehicle);

        // Scheduling
        $clienteACL->permissions()->attach($listScheduling);
        $clienteACL->permissions()->attach($cancelScheduling);
        $clienteACL->permissions()->attach($createScheduling);
        $clienteACL->permissions()->attach($editScheduling);

        $funcionarioACL->permissions()->attach($listScheduling);
        $funcionarioACL->permissions()->attach($createScheduling);
        $funcionarioACL->permissions()->attach($approveScheduling);
        $funcionarioACL->permissions()->attach($cancelScheduling);

        $gerenteACL->permissions()->attach($listScheduling);
        $gerenteACL->permissions()->attach($createScheduling);
        $gerenteACL->permissions()->attach($approveScheduling);
        $gerenteACL->permissions()->attach($cancelScheduling);
        $gerenteACL->permissions()->attach($deleteScheduling);
        $gerenteACL->permissions()->attach($showScheduling);
        $gerenteACL->permissions()->attach($editScheduling);

        $gerenteMasterACL->permissions()->attach($listScheduling);
        $gerenteMasterACL->permissions()->attach($createScheduling);
        $gerenteMasterACL->permissions()->attach($approveScheduling);
        $gerenteMasterACL->permissions()->attach($cancelScheduling);
        $gerenteMasterACL->permissions()->attach($deleteScheduling);
        $gerenteMasterACL->permissions()->attach($showScheduling);
        $gerenteMasterACL->permissions()->attach($editScheduling);

        // Product
        $funcionarioACL->permissions()->attach($listProduct);
        $funcionarioACL->permissions()->attach($deleteProduct);
        $funcionarioACL->permissions()->attach($createProduct);
        $funcionarioACL->permissions()->attach($showProduct);
        $funcionarioACL->permissions()->attach($editProduct);

        $gerenteACL->permissions()->attach($listProduct);
        $gerenteACL->permissions()->attach($deleteProduct);
        $gerenteACL->permissions()->attach($createProduct);
        $gerenteACL->permissions()->attach($showProduct);
        $gerenteACL->permissions()->attach($editProduct);

        $gerenteMasterACL->permissions()->attach($listProduct);
        $gerenteMasterACL->permissions()->attach($deleteProduct);
        $gerenteMasterACL->permissions()->attach($createProduct);
        $gerenteMasterACL->permissions()->attach($showProduct);
        $gerenteMasterACL->permissions()->attach($editProduct);

        // Service
        $funcionarioACL->permissions()->attach($listService);
        $funcionarioACL->permissions()->attach($deleteService);
        $funcionarioACL->permissions()->attach($createService);
        $funcionarioACL->permissions()->attach($showService);
        $funcionarioACL->permissions()->attach($editService);

        $gerenteACL->permissions()->attach($listService);
        $gerenteACL->permissions()->attach($deleteService);
        $gerenteACL->permissions()->attach($createService);
        $gerenteACL->permissions()->attach($showService);
        $gerenteACL->permissions()->attach($editService);

        $gerenteMasterACL->permissions()->attach($listService);
        $gerenteMasterACL->permissions()->attach($deleteService);
        $gerenteMasterACL->permissions()->attach($createService);
        $gerenteMasterACL->permissions()->attach($showService);
        $gerenteMasterACL->permissions()->attach($editService);

        // Client
        $funcionarioACL->permissions()->attach($listClient);
        $funcionarioACL->permissions()->attach($createClient);
        $funcionarioACL->permissions()->attach($showClient);

        $gerenteACL->permissions()->attach($createClient);
        $gerenteACL->permissions()->attach($listClient);
        $gerenteACL->permissions()->attach($showClient);
        $gerenteACL->permissions()->attach($deleteClient);
        $gerenteACL->permissions()->attach($editClient);

        $gerenteMasterACL->permissions()->attach($createClient);
        $gerenteMasterACL->permissions()->attach($listClient);
        $gerenteMasterACL->permissions()->attach($showClient);
        $gerenteMasterACL->permissions()->attach($deleteClient);
        $gerenteMasterACL->permissions()->attach($editClient);


        $funcionarioACL->permissions()->attach($orderService);
        $gerenteACL->permissions()->attach($listFuncionarios);
        $funcionarioACL->permissions()->attach($produtosEndServicos);

        echo "Registros de ACL criado! \n";
    }
}
