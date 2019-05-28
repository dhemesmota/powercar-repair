<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rota para traduzir linguagem
Route::get('lang', function () {
    $lang = session('lang','pt-br');
    if($lang == 'pt-br'){
        $lang = "en";
    } else {
        $lang = "pt-br";
    }
    session(['lang'=>$lang]);
    return redirect()->back();
})->name('lang');

// Rota pagina de boas vindas
Route::get('/modelo', function () {
    return view('modelo.welcome');
});

Auth::routes();

Route::namespace('Site')->group(function (){
    Route::get('/', 'PrincipalController@index')->name('principal');
});

// namespace : é a pasta onde está as controllers
Route::middleware('auth')->namespace('Admin')->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
});

// Rotas para o administrativo 
// Usando o middleware('can:') para barrar acesso não autorizado
Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function (){
    // Controle users
    Route::resource('/users', 'UserController');
    /*
        Route::get('/users','UserController@index')->name('users.index')->middleware('can:list-user');
        Route::get('/users/{user}','UserController@show')->name('users.show')->middleware('can:show-user');
        Route::get('/users/{user}/edit','UserController@edit')->name('users.edit')->middleware('can:edit-user'); 
        Route::get('/users/create','UserController@create')->name('users.create')->middleware('can:create-user');
        Route::post('/users','UserController@store')->name('users.store')->middleware('can:create-user');
        Route::put('/users/{user}','UserController@update')->name('users.update')->middleware('can:edit-user');
        Route::delete('/users/{user}','UserController@destroy')->name('users.destroy')->middleware('can:delete-user');
    */
    Route::resource('/profile', 'ProfileController');
    Route::resource('/services', 'ServiceController');
    Route::resource('/products', 'ProductController');
    Route::resource('/vehicles', 'VehicleController');
    Route::resource('/clients', 'ClientController');
    Route::resource('/situations', 'SituationController');
    Route::resource('/employees', 'EmployeeController');
    Route::resource('/schedulings', 'SchedulingController');
    Route::get('/schedulings/{id}/approve', 'SchedulingController@approve')->name('schedulings.approve'); // Aprovar agendamento
    Route::get('/schedulings/{id}/cancel', 'SchedulingController@cancel')->name('schedulings.cancel'); // Cancelar agendamento
    Route::resource('/budgets', 'BudgetController');
    Route::get('/budgets/{id}/product/add','BudgetController@product')->name('budgets.product');
    Route::post('/budgets/{id}/product/store','BudgetController@storeProduct')->name('budgets.storeProduct');
    Route::get('/budgets/{id}/service/add','BudgetController@service')->name('budgets.service');
    Route::get('/budgets/{id}/{client_id}/vehicle/add','BudgetController@vehicle')->name('budgets.vehicle');
    Route::put('/budgets/{id}/vehicle','BudgetController@storeVehicle')->name('budgets.storeVehicle');
});

Route::prefix('admin')->middleware(['auth','can:acl'])->namespace('Admin')->group(function () {
    Route::resource('/permissions', 'PermissionController');
    Route::resource('/roles', 'RoleController');
});
