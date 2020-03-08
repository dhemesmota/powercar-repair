<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SchedulingRepositoryInterface;
use App\Repositories\Contracts\SituationRepositoryInterface;
use Validator;
use Illuminate\Validation\Rule;
use DB;


use Illuminate\Support\Facades\Gate;
use App\Situation;

class SchedulingController extends Controller
{

    private $route = 'schedulings';
    private $paginate = 10;
    private $search = ['date','hour'];
    private $model;
    private $modelSituation;

    public function __construct(SchedulingRepositoryInterface $model, SituationRepositoryInterface $modelSituation)
    {
        $this->model = $model;
        $this->modelSituation = $modelSituation;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies( 'list-scheduling' )) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg',trans('linguagem.access_denied'));
            session()->flash('status','error');
            return redirect()->route('home');
        }

        // Definiando as colunas e traduzação das colunas
        $isCliente = auth()->user()->isClient();
        if($isCliente){
            $columnList = [
                'id'=>'#',
                'date'=>trans('linguagem.date'),
                'hour'=>trans('linguagem.hour'),
                'description'=>trans('linguagem.description'),
                'name'=>trans('linguagem.situation'),
            ];

            $isClient = true;
        } else {
            $columnList = [
                'id'=>'#',
                'date'=>trans('linguagem.date'),
                'hour'=>trans('linguagem.hour'),
                'description'=>trans('linguagem.description'),
                'name'=>trans('linguagem.situation'),
                'client' => trans('linguagem.client'),
            ];

            $isClient = false;
        }

        $search = "";
        if(isset($request->search) and !empty($request->search)){
            $search = $request->search;
            $list = $this->model->findWhereLike($this->search,$search,'id','DESC');
        } else {
            $list = $this->model->paginate($this->paginate, 'id', 'DESC'); // para criar paginaçao com 5 itens por pagina
            //$list = $this->model->all(); // trás todos os usuários
        }

        $page = trans('linguagem.scheduling_list'); // traduzindo o titulo da lista

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
        //$this->authorize('create-scheduling'); // Verifica se tem autorização de acesso
        if (Gate::denies('create-scheduling')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $page = trans('linguagem.scheduling_list'); // traduzindo o titulo da lista
        $page_create = trans('linguagem.scheduling');
        $routeName = $this->route; // passando a rota - caminho

        $isCliente = auth()->user()->isClient();
        if($isCliente){
            $situation = [];
            $client = [];
        } else {
            // Se não for usuário cliente, então terá opção de selecionar situação
            // buscar situações
            $situation = $this->modelSituation->all('name','ASC');
            // buscar clientes
            $client = DB::table('users')
                            ->join('role_user', function ($join) {
                                $join->on('users.id', '=', 'role_user.user_id')
                                    ->where('role_user.role_id', '=', 5);
                            })
                            ->select('users.id','users.name')
                            ->orderBy('users.name', 'ASC')
                            ->get();
        }
        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
            (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.list',['page'=>$page])],
            (object)['url'=>'','title'=>trans('linguagem.create_crud',['page'=>$page_create])]
        ];

        return view('admin.'.$routeName.'.create',compact('page','page_create','routeName','breadcrumb', 'situation','client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize('create-scheduling'); // Verifica se tem autorização de acesso
        if (Gate::denies('create-scheduling')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }


        $data = $request->all();

        Validator::make($data, [
            'date' => ['required'],
            'hour' => ['required'],
            'description' => ['required', 'string', 'min:5', 'max:254']
        ])->validate();

        $isCliente = auth()->user()->hasRole('Cliente');
        // Se o usuário for cliente, então seleciona a situação como pendente
        if ($isCliente) {
            // buscar situações
            $situation = Situation::where('name', '=', 'Pendente')->firstOrFail();
            $data['situation_id'] = $situation->id;

            // Pegando o id do cliente logado responsável pelo agendamento
            $userId = auth()->user()->id;
            $data['user_id'] = $userId;
        } else {
            Validator::make($data, [
                'date' => ['required'],
                'hour' => ['required'],
                'description' => ['required', 'string', 'min:5', 'max:254'],
                'situation_id' => ['required'],
                'user_id' => ['required']
            ])->validate();
        }


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

        if (Gate::denies('show-scheduling')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $routeName = $this->route;

        $register = $this->model->find($id);
        if($register){

            $page = trans('linguagem.scheduling_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.scheduling');

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
            } else {
                return redirect()->route($routeName.'.index');
            }

            return view('admin.'.$routeName.'.show',compact('register','page','page2','routeName','breadcrumb','delete'));
        }

        return redirect()->route($routeName.'.index');
    }

    /**
     * Aprovar agendamento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        if (Gate::denies('approve-scheduling')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        if(empty($id) or !isset($id)) {
            $routeName = $this->route;
            return redirect()->route($routeName.'.index');
        }

        $situation = DB::table('situations')->where('name','=','Aprovado')->first();
        if (!isset($situation->id)) {
            session()->flash('msg',trans('linguagem.error_editing_record'));
            session()->flash('status','error'); // tipos: success error notification
            return redirect()->back();
        }
        $data['situation_id'] = $situation->id;

        if($this->model->update($data,$id)) {
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
     * Cancelar agendamento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        if (Gate::denies('cancel-scheduling')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        if (empty($id) or !isset($id)) {
            $routeName = $this->route;
            return redirect()->route($routeName.'.index');
        }

        $situation = DB::table('situations')->where('name','=','Cancelado')->first();
        if (!isset($situation->id)) {
            session()->flash('msg',trans('linguagem.error_editing_record'));
            session()->flash('status','error'); // tipos: success error notification
            return redirect()->back();
        }
        $data['situation_id'] = $situation->id;

        if($this->model->update($data,$id)) {
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('edit-scheduling')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        $routeName = $this->route;

        return redirect()->route($routeName.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete-scheduling')) {
            // Caso não tenha acesso a pagina, será redirecionado a pagina home
            session()->flash('msg', trans('linguagem.access_denied'));
            session()->flash('status', 'error');
            return redirect()->back();
        }

        if($this->model->delete($id)){
            session()->flash('msg',trans('linguagem.registration_deleted_successfully'));
            session()->flash('status','success'); // tipos: success error notification
        } else {
            session()->flash('msg',trans('linguagem.error_deleting_record'));
            session()->flash('status','error'); // tipos: success error notification
        }
        $routeName = $this->route; // passando a rota - caminho
        // Redirecionar para listagem de usuários
        return redirect()->route($routeName.'.index');
    }
}
