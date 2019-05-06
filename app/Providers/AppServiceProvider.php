<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Primeiro parametro qual interface vai definir e em segundo qual class a interface vai receber uma instancia
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\PermissionRepositoryInterface',
            'App\Repositories\Eloquent\PermissionRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\RoleRepositoryInterface',
            'App\Repositories\Eloquent\RoleRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\ProfileRepositoryInterface',
            'App\Repositories\Eloquent\ProfileRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\ServiceRepositoryInterface',
            'App\Repositories\Eloquent\ServiceRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\ProductRepositoryInterface',
            'App\Repositories\Eloquent\ProductRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\VehicleRepositoryInterface',
            'App\Repositories\Eloquent\VehicleRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\ClientRepositoryInterface',
            'App\Repositories\Eloquent\ClientRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Registrando components para o blade
        Blade::component('components.page', 'page_component');
        Blade::component('components.alert', 'alert_component');
        Blade::component('components.breadcrumb','breadcrumb_component');
        Blade::component('components.search','search_component');
        Blade::component('components.table','table_component');
        Blade::component('components.paginate','paginate_component');
        Blade::component('components.form','form_component');

        // Componentes funções de usuario
        Blade::component('components.home.cliente','cliente_component');
        Blade::component('components.home.administrador','admin_component');
        Blade::component('components.home.gerenteMaster','gerente_master_component');
        Blade::component('components.home.gerente','gerente_component');
        Blade::component('components.home.funcionario','funcionario_component');
    }
}
