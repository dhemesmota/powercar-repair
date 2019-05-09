<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        }

        return view('home',compact('roleUsuario'));
    }
}
