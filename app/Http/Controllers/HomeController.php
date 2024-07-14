<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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


        // ----------------------------- check code start ---------------------??
        // $roleCheck = Auth::user()->roles()->get()->toArray();
        // $roleCheckName = !empty($roleCheck[0]['name']) ? $roleCheck[0]['name'] : ' ';
        // $roleCheckId = !empty($roleCheck[0]['id']) ? $roleCheck[0]['id'] : ' ';
        // dd($roleCheckName);
        // ----------------------------- check code end ---------------------??

        
        $currentLoginRoleInfo = Auth::user()->roles()->get()->toArray();
        $currentLoginRoleInfo = !empty($currentLoginRoleInfo[0]['name']) ? $currentLoginRoleInfo[0]['name'] : '' ;

        // dd($currentLoginRoleInfo);
        if($currentLoginRoleInfo == "Student"){

        return view('dashboard');

        }else if($currentLoginRoleInfo == "Teacher"){
            
        return view('dashboard');

        }
        return view('home');
        
    }

}
