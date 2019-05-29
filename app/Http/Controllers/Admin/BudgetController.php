<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BudgetRepositoryInterface;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Validator;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{

    private $route = 'budgets';
    private $paginate = 10;
    private $search = ['description'];
    private $model;
    private $modelClient;
    private $modelEmployee;

    public function __construct(BudgetRepositoryInterface $model, ClientRepositoryInterface $modelClient, EmployeeRepositoryInterface $modelEmployee)
    {
        $this->model = $model;
        $this->modelClient = $modelClient;
        $this->modelEmployee = $modelEmployee;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $isClient = auth()->user()->isClient();
        if(!$isClient){
            // Definiando as colunas e traduzação das colunas
            $columnList = [
                'id'=>'#',
                'description'=>trans('linguagem.description'),
                'total_price'=>trans('linguagem.total_price'),
                'client'=>trans('linguagem.client'),
                'model'=>trans('linguagem.vehicle'),
                'employee'=>trans('linguagem.employee'),
                'name'=>trans('linguagem.situation')
            ];
        } else {
            $columnList = [
                'id'=>'#',
                'description'=>trans('linguagem.description'),
                'total_price'=>trans('linguagem.total_price'),
                'model'=>trans('linguagem.vehicle'),
                'employee'=>trans('linguagem.employee'),
                'name'=>trans('linguagem.situation')
            ];
        }
        //'description', 'total_price', 'client_id', 'vehicle_id', 'employee_id'

        $search = "";
        if(isset($request->search) and !empty($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search,$search,'id','DESC');
        } else {
            $list = $this->model->paginate($this->paginate, 'id', 'DESC'); // para criar paginaçao com 5 itens por pagina
            //$list = $this->model->all(); // trás todos os usuários
        }

        $page = trans('linguagem.budget_list'); // traduzindo o titulo da lista

        $routeName = $this->route; // passando a rota - caminho

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
            (object)['url'=>'','title'=>trans('linguagem.list',['page'=>$page])]
        ];

        return view('admin.'.$routeName.'.index',compact('list','search','page','routeName','columnList','breadcrumb','isClient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page = trans('linguagem.budget_list'); // traduzindo o titulo da lista
        $page_create = trans('linguagem.budget');
        $routeName = $this->route; // passando a rota - caminho

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
            (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.list',['page'=>$page])],
            (object)['url'=>'','title'=>trans('linguagem.create_crud',['page'=>$page_create])]
        ];

        $clients = $this->modelClient->all(); // buscando todos os clientes

        $isEmployee = auth()->user()->isEmployee();
        if($isEmployee){
            $employees = [];
        } else {
            $employees = $this->modelEmployee->all();
        }

        return view('admin.'.$routeName.'.create',compact('page','page_create','routeName','breadcrumb','clients','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $isEmployee = auth()->user()->isEmployee();
        if($isEmployee) {
            Validator::make($data, [
                'client_id' => ['required'],
                'description' => ['required', 'string', 'max:255']
            ])->validate();

            $data['employee_id'] = auth()->user()->id;
        } else {
            Validator::make($data, [
                'client_id' => ['required'],
                'description' => ['required', 'string', 'max:255'],
                'employee_id' => ['required']
            ])->validate();
        }

        //dd($data);
        $data['situation_id'] = 9;

        if($this->model->create($data)){
            session()->flash('msg',trans('linguagem.record_added_successfully'));
            session()->flash('status','success'); // tipos: success error notification
            return redirect()->back();
        } else {
            session()->flash('msg',trans('linguagem.error_adding_record'));
            session()->flash('status','error'); // tipos: success error notification
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $routeName = $this->route; // passando a rota - caminho

        $register = $this->model->find($id);
        if($register){
            $register = $register[0];
            $page = trans('linguagem.budget_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.budget');

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
                (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.list',['page'=>$page])],
                (object)['url'=>'','title'=>trans('linguagem.show_crud',['page'=>$page2])]
            ];
            
            // Verificar se o usuário deseja deletar o registro, vendo se o delete foi recebido por parametro
            $delete = false;
            if ($request->delete ?? false) {
                session()->flash('msg',trans('linguagem.delete_this_record'));
                session()->flash('status','notification'); // tipos: success error notification
                $delete = true;
            }

            return view('admin.'.$routeName.'.show',compact('register','page','page2','routeName','breadcrumb','delete'));
        }

        return redirect()->route($routeName.'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routeName = $this->route; // passando a rota - caminho

        $register = $this->model->find($id);
        if($register){
            
            $page = trans('linguagem.budget_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.budget');

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
                (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.list',['page'=>$page])],
                (object)['url'=>'','title'=>trans('linguagem.edit_crud',['page'=>$page2])]
            ];

            return view('admin.'.$routeName.'.edit',compact('register','page','page2','routeName','breadcrumb'));
        }

        // Caso não encontre o usuário retornar para lista de usuários
        return redirect()->route($routeName.'.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        Validator::make($data, [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:40']
        ])->validate();

        if($this->model->update($data,$id)){
            session()->flash('msg',trans('linguagem.successfully_edited_record'));
            session()->flash('status','success'); // tipos: success error notification
            return redirect()->back();
        } else {
            session()->flash('msg',trans('linguagem.error_editing_record'));
            session()->flash('status','error'); // tipos: success error notification
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->model->delete($id)){
            session()->flash('msg',trans('linguagem.registration_deleted_successfully'));
            session()->flash('status','success'); // tipos: success error notification
        } else {
            session()->flash('msg',trans('linguagem.error_editing_record'));
            session()->flash('status','error'); // tipos: success error notification
        }
        $routeName = $this->route; // passando a rota - caminho
        // Redirecionar para listagem de usuários 
        return redirect()->route($routeName.'.index');
    }


    /**
     * Adicionar veiculo
     */
    public function vehicle($id, $client_id)
    {
        
        $vehicles = DB::table('vehicles')->where('user_id', $client_id)->get();
        $ordemId = $id;

        if(empty($vehicles[0])){
            session()->flash('msg',"Cliente sem nenhum veículo cadastrado, para gerar um orçamento é necessário cadastrar um veículo.");
            session()->flash('status','error'); // tipos: success error notification
            return redirect()->back();
        }

        $page = trans('linguagem.budget_list'); // traduzindo o titulo da lista
        $page_create = trans('linguagem.budget');
        $routeName = $this->route; // passando a rota - caminho

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
            (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.list',['page'=>$page])],
            (object)['url'=>'','title'=>'Adicinar veículo']
        ];

        return view('admin.'.$routeName.'.addVehicle',compact('page','page_create','routeName','breadcrumb','vehicles','ordemId'));

        dd($vehicles);
    }
    public function storeVehicle(Request $request, $id)
    {
        $data = $request->all();

        Validator::make($data, [
            'vehicle_id' => ['required']
        ])->validate();

        //dd($data);
        if ($this->model->updateVehicle($data,$id)) {
            session()->flash('msg', trans('linguagem.record_added_successfully'));
            session()->flash('status', 'success'); // tipos: success error notification
            return redirect()->route('budgets.index');
        } else {
            session()->flash('msg', trans('linguagem.error_adding_record'));
            session()->flash('status', 'error'); // tipos: success error notification
            return redirect()->back();
        }
    }

    /**
     * Adicionar produtos
     */
    public function product($id)
    {

        $products = DB::table('products')->where('stock','=','s')->get();
        $ordemId = $id;

        // buscar todos os produtos já adicionado a ordem de serviço
        $list = DB::table('budget_products')
                    ->join('products','budget_products.product_id', '=', 'products.id')
                    ->where('budget_id','=',$id)
                    ->select('budget_products.*','products.name as product')
                    ->get();

        $columnList = [
            'budget_id' => trans('linguagem.budget'),
            'product' => trans('linguagem.product'),
            'value' => trans('linguagem.value'),
            'amount' => trans('linguagem.amount'),
            'total_value' => trans('linguagem.total_price')
        ];

        $page = trans('linguagem.budget_list'); // traduzindo o titulo da lista
        $page_create = trans('linguagem.budget');
        $routeName = $this->route; // passando a rota - caminho

        $breadcrumb = [
            (object)['url' => route('home'), 'title' => trans('linguagem.home')],
            (object)['url' => route($routeName . '.index'), 'title' => trans('linguagem.list', ['page' => $page])],
            (object)['url' => '', 'title' => 'Adicinar produtos']
        ];

        return view('admin.' . $routeName . '.product', compact('page', 'page_create', 'routeName', 'breadcrumb', 'products', 'ordemId', 'list', 'columnList'));

        dd($products);
    }
    public function storeProduct(Request $request, $id)
    {
        $data = $request->all();

        Validator::make($data, [
            'product_id' => ['required'],
            'amount' => ['required']
        ])->validate();

        // verificar se registro já existe
        $register = DB::table('budget_products')
                        ->select('product_id')
                        ->where('budget_id','=',$id)
                        ->where('product_id','=',$data['product_id'])
                        ->get();
        
        if(!empty($register[0])){
            session()->flash('msg',trans('linguagem.product_already_added'));
            session()->flash('status','notification'); // tipos: success error notification
            return redirect()->back();
        }

        $product_id = (int) $data['product_id'];
        $amount = (int) $data['amount'];

        $value = DB::table('products')->where('id','=',$product_id)->select('value')->get();

        $price = (float) $value[0]->value;

        $data['budget_id'] = $id;
        $data['value'] = $price;
        $data['total_value'] = $price * $amount;

        // buscando valor já adicionando na OS
        $result = DB::table('budgets')->select('total_price')->where('id', '=', $id)->get();
        $valorTotal = (float) $result[0]->total_price;
        $valorTotal += $data['total_value'];

        if($this->model->createProduct($data)){

            DB::table('budgets')->where('id','=',$id)->update(['total_price' => $valorTotal]);

            session()->flash('msg',trans('linguagem.record_added_successfully'));
            session()->flash('status','success'); // tipos: success error notification
            return redirect()->back();
        } else {
            session()->flash('msg',trans('linguagem.error_adding_record'));
            session()->flash('status','error'); // tipos: success error notification
            return redirect()->back();
        }
    }
    public function deleteProduct($id, $product_id)
    {
        $valueProduct = DB::table('budget_products')
                        ->where('product_id','=',$product_id)
                        ->where('budget_id','=',$id)
                        ->select('total_value')->get();

        $result = DB::table('budgets')->select('total_price')->where('id', '=', $id)->get();
        $valorTotal = (float) $result[0]->total_price;
        if($valorTotal >= $valueProduct[0]->total_value){
            $valorTotal -= (float) $valueProduct[0]->total_value;
        } else {
            $valorTotal = "0.00";
        }

        if ($this->model->deleteProduct($id, $product_id)) {

            DB::table('budgets')->where('id','=',$id)->update(['total_price' => $valorTotal]);

            session()->flash('msg', trans('linguagem.registration_deleted_successfully'));
            session()->flash('status', 'success'); // tipos: success error notification
            return redirect()->back();
        } else {
            session()->flash('msg', trans('linguagem.error_deleting_record'));
            session()->flash('status', 'error'); // tipos: success error notification
            return redirect()->back();
        }
    }




    /**
     * Adicionar serviços
     */
    public function service($id)
    {

        $services = DB::table('services')->get();
        $ordemId = $id;

        // buscar todos os serviços já adicionado a ordem de serviço
        $list = DB::table('budget_services')
            ->join('services', 'budget_services.service_id', '=', 'services.id')
            ->where('budget_id', '=', $id)
            ->select('budget_services.*', 'services.*')
            ->get();

        $columnList = [
            'name' => trans('linguagem.service'),
            'description' => trans('linguagem.description'),
            'value' => trans('linguagem.value')
        ];

        $page = trans('linguagem.budget_list'); // traduzindo o titulo da lista
        $page_create = trans('linguagem.budget');
        $routeName = $this->route; // passando a rota - caminho

        $breadcrumb = [
            (object)['url' => route('home'), 'title' => trans('linguagem.home')],
            (object)['url' => route($routeName . '.index'), 'title' => trans('linguagem.list', ['page' => $page])],
            (object)['url' => '', 'title' => 'Adicinar serviços']
        ];

        return view('admin.' . $routeName . '.service', compact('page', 'page_create', 'routeName', 'breadcrumb', 'services', 'ordemId', 'list', 'columnList'));

        dd($services);
    }
    public function storeService(Request $request, $id)
    {
        $data = $request->all();

        Validator::make($data, [
            'service_id' => ['required']
        ])->validate();

        // verificar se registro já existe
        $register = DB::table('budget_services')
                        ->select('service_id')
                        ->where('budget_id','=',$id)
                        ->where('service_id','=',$data['service_id'])
                        ->get();
        
        if(!empty($register[0])){
            session()->flash('msg',"Serviço já adicionado");
            session()->flash('status','notification'); // tipos: success error notification
            return redirect()->back();
        }

        $service_id = (int) $data['service_id'];
        $value = DB::table('services')->where('id','=',$service_id)->select('value')->get();
        $price = (float) $value[0]->value;


        // buscando valor já adicionando na OS
        $result = DB::table('budgets')->select('total_price')->where('id', '=', $id)->get();
        $valorTotal = (float) $result[0]->total_price;
        $valorTotal += $price;

        $data['budget_id'] = $id;

        if($this->model->createService($data)){

            DB::table('budgets')->where('id','=',$id)->update(['total_price' => $valorTotal]);

            session()->flash('msg',trans('linguagem.record_added_successfully'));
            session()->flash('status','success'); // tipos: success error notification
            return redirect()->back();
        } else {
            session()->flash('msg',trans('linguagem.error_adding_record'));
            session()->flash('status','error'); // tipos: success error notification
            return redirect()->back();
        }
    }
    public function deleteService($id, $service_id)
    {
        $valueService = DB::table('services')
                        ->where('id','=',$service_id)
                        ->select('value')->get();

        $result = DB::table('budgets')->select('total_price')->where('id', '=', $id)->get();
        $valorTotal = (float) $result[0]->total_price;
        if($valorTotal >= $valueService[0]->value){
            $valorTotal -= (float) $valueService[0]->value;
        } else {
            $valorTotal = "0.00";
        }

        if ($this->model->deleteService($id, $service_id)) {

            DB::table('budgets')->where('id','=',$id)->update(['total_price' => $valorTotal]);

            session()->flash('msg', trans('linguagem.registration_deleted_successfully'));
            session()->flash('status', 'success'); // tipos: success error notification
            return redirect()->back();
        } else {
            session()->flash('msg', trans('linguagem.error_deleting_record'));
            session()->flash('status', 'error'); // tipos: success error notification
            return redirect()->back();
        }
    }

    public function approveCancel($id, $condicao)
    {
        if($condicao == 1){
            // aprovar
            DB::table('budgets')->where('id','=',$id)->update(['situation_id' => 7]);
            session()->flash('msg', "O.S. aprovada com sucesso");
            session()->flash('status', 'success'); // tipos: success error notification
            return redirect()->back();
        } else {
            // cancelar
            DB::table('budgets')->where('id','=',$id)->update(['situation_id' => 6]);
            session()->flash('msg', "O.S. cancelada com sucesso");
            session()->flash('status', 'success'); // tipos: success error notification
            return redirect()->back();
        }
    }
}
