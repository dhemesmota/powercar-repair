<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\Contracts\SchedulingRepositoryInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SchedulingRepositoryInterface $model)
    {
        $this->model = $model;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $roleUsuario = DB::table('role_user')
                                ->join('roles','role_user.role_id','=','roles.id')
                                ->select('roles.id','roles.name')
                                ->where('role_user.user_id','=',$userId)
                                ->get();
        //dd($roleUsuario);

        // Verificar se é cliente, se sim, verificar perfil
        if($roleUsuario[0]->id > 4){
            $profile = DB::table('profiles')->where('user_id',$userId)->first();
            // Verificar se o perfil já contem dados, se não, redirecionar para página de perfil
            if($profile == null) {
                session()->flash('msg',trans( 'linguagem.complete_profile_data'));
                session()->flash('status','notification'); // tipos: success error notification
                return redirect()->route('profile.index');
            }

            $columnList = [
                'id'=>'#',
                'date'=>trans('linguagem.date'),
                'hour'=>trans('linguagem.hour'),
                'description'=>trans('linguagem.description'),
                'name'=>trans('linguagem.situation'),
            ];

            $list = $this->model->listLimit(2, 'date', 'DESC');

            $routeName = 'schedulings';

            $listBudgetsClient = [
                'id'=>'#',
                'description'=>trans('linguagem.description'),
                'total_price'=>trans('linguagem.total_price'),
                'model'=>trans('linguagem.vehicle'),
                'employee'=>trans('linguagem.employee'),
                'name'=>trans('linguagem.situation'),
                'created_at'=>"Data de registro",
            ];
    
            $budgetsClient = DB::table('budgets')
            ->join('users AS us', 'budgets.client_id', '=', 'us.id')
            ->leftJoin('vehicles', 'budgets.vehicle_id', '=', 'vehicles.id')
            ->join('users AS ep', 'budgets.employee_id', '=', 'ep.id')
            ->join('situations', 'budgets.situation_id', '=', 'situations.id')
            ->select('budgets.*', 'us.name as client', 'vehicles.model','ep.name as employee','situations.name', 'situations.description as status_description', 'situations.color')
            ->where('budgets.client_id','=',$userId)
            ->orderBy('budgets.created_at', 'DESC')
            ->limit(3)
            ->get();

            //dd($list);

            return view('home',compact('roleUsuario','columnList','list','routeName','listBudgetsClient','budgetsClient'));
        }


        $columnListBudgets = [
            'id'=>'#',
            'description'=>trans('linguagem.description'),
            'total_price'=>trans('linguagem.total_price'),
            'client'=>trans('linguagem.client'),
            'model'=>trans('linguagem.vehicle'),
            'employee'=>trans('linguagem.employee'),
            'name'=>trans('linguagem.situation')
        ];

        $budgets = DB::table('budgets')
        ->join('users AS us', 'budgets.client_id', '=', 'us.id')
        ->leftJoin('vehicles', 'budgets.vehicle_id', '=', 'vehicles.id')
        ->join('users AS ep', 'budgets.employee_id', '=', 'ep.id')
        ->join('situations', 'budgets.situation_id', '=', 'situations.id')
        ->select('budgets.*', 'us.name as client', 'vehicles.model','ep.name as employee','situations.name', 'situations.description as status_description', 'situations.color')
        ->orderBy('budgets.id', 'DESC')
        ->limit(3)
        ->get();

        $osPendente = DB::table('budgets')->where('situation_id','=','9')->count();
        $osNova = DB::table('budgets')->where('situation_id','=','7')->count();
        $osConcluida = DB::table('budgets')->count();

        return view('home',compact('roleUsuario','columnListBudgets','budgets','osPendente','osNova','osConcluida'));
    }
}
