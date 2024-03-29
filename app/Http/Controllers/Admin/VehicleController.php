<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\VehicleRepositoryInterface;
use Validator;

use Illuminate\Support\Facades\Gate;
class VehicleController extends Controller
{

    private $route = 'vehicles';
    private $paginate = 10;
    private $search = ['model','color','year','board'];
    private $model;

    public function __construct(VehicleRepositoryInterface $model)
    {
        $this->model = $model;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies('list-vehicle')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        // Definiando as colunas e traduzação das colunas
        $columnList = ['id'=>'#','model'=>trans('linguagem.model'),'color'=>trans('linguagem.color'),'year'=>trans('linguagem.year'), 'board'=>trans('linguagem.board')];

        $search = "";
        if(isset($request->search) and !empty($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search,$search,'model','ASC');
        } else {
            $list = $this->model->paginate($this->paginate, 'model', 'ASC'); // para criar paginaçao com 5 itens por pagina
            //$list = $this->model->all(); // trás todos os usuários
        }

        $page = trans('linguagem.vehicle_list'); // traduzindo o titulo da lista

        $routeName = $this->route; // passando a rota - caminho

        //session()->flash('msg','Olá');
        //session()->flash('status','success'); // tipos: success error notification

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
            (object)['url'=>'','title'=>trans('linguagem.list',['page'=>$page])]
        ];

        return view('admin.'.$routeName.'.index',compact('list','search','page','routeName','columnList','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Gate::denies('create-vehicle')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }


        $page = trans('linguagem.vehicle_list'); // traduzindo o titulo da lista
        $page_create = trans('linguagem.vehicle');
        $routeName = $this->route; // passando a rota - caminho

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
            (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.list',['page'=>$page])],
            (object)['url'=>'','title'=>trans('linguagem.create_crud',['page'=>$page_create])]
        ];

        return view('admin.'.$routeName.'.create',compact('page','page_create','routeName','breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-vehicle')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $data = $request->all();//'model','color','year','board'

        Validator::make($data, [
            'model' => ['required', 'string', 'min:4', 'max:255'],
            'color' => ['required', 'string', 'max:30'],
            'year' => ['required', 'string', 'max:9'],
            'board' => ['required', 'max:10'],
        ])->validate();
        
        
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
        if (Gate::denies('show-vehicle')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route; // passando a rota - caminho

        $register = $this->model->find($id);
        if($register){
            
            $page = trans('linguagem.vehicle_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.vehicle');

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
        if (Gate::denies('edit-vehicle')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $routeName = $this->route; // passando a rota - caminho

        $register = $this->model->find($id);
        if($register){
            
            $page = trans('linguagem.vehicle_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.vehicle');

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
        if (Gate::denies('edit-vehicle')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

        $data = $request->all();

        Validator::make($data, [
            'model' => ['required', 'string', 'min:4', 'max:255'],
            'color' => ['required', 'string', 'max:30'],
            'year' => ['required', 'string', 'max:8'],
            'board' => ['required', 'string', 'max:10'],
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
        if (Gate::denies('delete-vehicle')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->route('home');
        }

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
}
