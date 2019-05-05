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
        return view('home',compact('roleUsuario'));
    }
}
