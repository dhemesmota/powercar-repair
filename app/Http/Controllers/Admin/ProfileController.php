<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use Validator;
use Illuminate\Validation\Rule;


use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{

    private $route = 'profile';
    private $model;

    public function __construct(ProfileRepositoryInterface $model)
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

        
        $routeName = $this->route; // passando a rota - caminho

        $id = auth()->user()->id;
                
        $register = $this->model->allData($id);

        //dd($register);
        if($register){
            
            $page = trans('linguagem.profile'); // traduzindo o titulo da lista

            $breadcrumb = [
                (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
                (object)['url'=>'','title'=>trans('linguagem.profile')]
            ];

            $registerUser = auth()->user();

            return view('admin.'.$routeName.'.index',compact('register','registerUser','page','routeName','breadcrumb'));
        }

        // Caso não encontre o usuário retornar para lista de usuários
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $page = trans('linguagem.profile'); // traduzindo o titulo da lista
        //$page_create = trans('linguagem.user');
        $page_create = trans('linguagem.personal_data');
        $routeName = $this->route; // passando a rota - caminho

        $breadcrumb = [
            (object)['url'=>route('home'),'title'=>trans('linguagem.home')],
            (object)['url'=>route($routeName.'.index'),'title'=>trans('linguagem.profile')],
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

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        $cpf = str_replace('-', '', str_replace('.','', $data['cpf']));
        $telephone = str_replace('-', '', str_replace(') ', '', str_replace('(','', $data['telephone'])));
        $zip_code = str_replace('-', '', str_replace(' ','', $data['zip_code']));

        $data['cpf'] = $cpf;
        $data['telephone'] = $telephone;
        $data['zip_code'] = $zip_code;

        //dd($zip_code);
        Validator::make($data, [
            'cpf' => ['required', 'string', 'max:11', 'unique:profiles'],
            'telephone' => ['required', 'string', 'min:9', 'max:11'],
            'address' => ['string', 'min:6', 'max:255'],
            'neighborhood' => ['string', 'min:6', 'max:255'],
            'zip_code' => ['string', 'min:8', 'max:8'],
        ])->validate();

        //dd($data);
        if($this->model->create($data)){
            session()->flash('msg',trans('linguagem.record_added_successfully'));
            session()->flash('status','success'); // tipos: success error notification
            return redirect()->route('profile.index');
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

        dd($request);
        $register = $this->model->find($id);
        if($register){
            
            $page = trans('linguagem.user_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.user');

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

        $routeName = $this->route; // passando a rota - caminho

        $register = $this->model->find($id);
        if($register){
            
            $page = trans('linguagem.user_list'); // traduzindo o titulo da lista
            $page2 = trans('linguagem.user');

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

        $cpf = str_replace('-', '', str_replace('.','', $data['cpf']));
        $telephone = str_replace('-', '', str_replace(') ', '', str_replace('(','', $data['telephone'])));
        $zip_code = str_replace('-', '', str_replace(' ','', $data['zip_code']));

        $data['cpf'] = $cpf;
        $data['telephone'] = $telephone;
        $data['zip_code'] = $zip_code;

        Validator::make($data, [
            'cpf' => ['required', 'string', 'max:11', Rule::unique('profiles')->ignore($id)],
            'telephone' => ['required', 'string', 'min:9', 'max:11'],
            'address' => ['string', 'min:6', 'max:255'],
            'neighborhood' => ['string', 'min:6', 'max:255'],
            'zip_code' => ['string', 'min:8', 'max:8'],
        ])->validate();

        if($this->model->update($data,$id)){
            session()->flash('msg',trans('linguagem.successfully_edited_record'));
            session()->flash('status','success'); // tipos: success error notification
            return redirect()->route('profile.index');
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
        // criar uma opção de excluir conta
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
