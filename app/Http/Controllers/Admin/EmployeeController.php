<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Validator;
use Illuminate\Validation\Rule;
use DB;


use Illuminate\Support\Facades\Gate;

class EmployeeController extends Controller
{

    private $route = 'employees';
    private $paginate = 10;
    private $search = ['name','email'];
    private $model;
    private $modelRole;
    private $modelProfile;

    public function __construct(EmployeeRepositoryInterface $model, RoleRepositoryInterface $modelRole, ProfileRepositoryInterface $modelProfile)
    {
        $this->model = $model;
        $this->modelRole = $modelRole;
        $this->modelProfile = $modelProfile; 
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies( 'list-employee' )) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg',trans('linguagem.access_denied'));
            session()->flash('status','error');
            return redirect()->route('home');
        }

        // Definiando as colunas e traduzação das colunas
        $columnList = [
            'id'=>'#',
            'image'=>trans('linguagem.image'),
            'name'=>trans('linguagem.name'),
            'email'=>trans('linguagem.email')
        ];

        $search = "";
        if(isset($request->search) and !empty($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search,$search,'id','DESC');
        } else {
            $list = $this->model->paginate($this->paginate, 'id', 'DESC'); // para criar paginaçao com 5 itens por pagina
            //$list = $this->model->all(); // trás todos os usuários
        }

        $page = trans('linguagem.employee_list'); // traduzindo o titulo da lista

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
        //$this->authorize('create-employee'); // Verifica se tem autorização de acesso
        if (Gate::denies('create-employee')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $page = trans('linguagem.employee_list'); // traduzindo o titulo da lista
        $page_create = trans('linguagem.employee');
        $routeName = $this->route; // passando a rota - caminho

        // Pegar funções do usuário
        $roles = $this->modelRole->all('name','ASC');

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
            (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.list',['page'=>$page])],
            (object)['url'=>'','title'=>trans('linguagem.create_crud',['page'=>$page_create])]
        ];

        return view('admin.'.$routeName.'.create',compact('page','page_create','routeName','breadcrumb','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize('create-employee'); // Verifica se tem autorização de acesso
        if (Gate::denies('create-employee')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }


        $data = $request->all();

        Validator::make($data, [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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

        if (Gate::denies('show-employee')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $routeName = $this->route; // passando a rota - caminho

        $register = $this->model->find($id);
        $profile = \App\Profile::where('user_id',$id)->get();

        if($register){
            
            $page = trans('linguagem.employee_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.employee');

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

            return view('admin.'.$routeName.'.show',compact('register','page','page2','routeName','breadcrumb','delete','profile'));
        }

        // Caso não encontre o usuário retornar para lista de usuários
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
        if (Gate::denies('edit-employee')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $routeName = $this->route; // passando a rota - caminho

        $register = $this->model->find($id);
        if($register){
            
            $page = trans('linguagem.employee_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.employee');

            // Pegar funções do usuário
            $roles = $this->modelRole->all('name','ASC');

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
                (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.list',['page'=>$page])],
                (object)['url'=>'','title'=>trans('linguagem.edit_crud',['page'=>$page2])]
            ];

            return view('admin.'.$routeName.'.edit',compact('register','page','page2','routeName','breadcrumb','roles'));
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
        if (Gate::denies('edit-employee')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $data = $request->all();

        if(!$data['password']){
            unset($data['password']);
        }

        Validator::make($data, [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['sometimes', 'required', 'string', 'min:6', 'confirmed'],
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
        if (Gate::denies('delete-employee')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $perfil = \App\Profile::where('user_id',$id)->get(); // Buscando dados do perfil do usuário
        if(!empty($perfil[0])){
            // Se o usuário tiver perfil cadastrado, será então deletado
            $profile = DB::table('profiles')->where('user_id', '=', $id)->delete();
        } else {
            // se não tiver, então apenas deletar o acesso do usuário
            $profile = 1;
        }
        if($profile){
            if($this->model->delete($id)){
                session()->flash('msg',trans('linguagem.registration_deleted_successfully'));
                session()->flash('status','success'); // tipos: success error notification
            } else {
                session()->flash('msg',trans('linguagem.error_deleting_record'));
                session()->flash('status','error'); // tipos: success error notification
            }
        } else {
            session()->flash('msg', trans('linguagem.error_deleting_record'));
            session()->flash('status', 'error'); // tipos: success error notification
        }
        $routeName = $this->route; // passando a rota - caminho
        // Redirecionar para listagem de usuários 
        return redirect()->route($routeName.'.index');
    }
}
